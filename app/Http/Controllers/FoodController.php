<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessZipUploadRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;
use ZipArchive;
use Illuminate\Http\File as IlluminateFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->query('q');
        $priceMax    = $request->query('price');
        $ratingMin   = $request->query('rating');
        $sort        = $request->query('sort');

        // Popular foods from cache
        $popular = Cache::remember('popular_foods', now()->addHours(1), function () {
            return Food::with('restaurant')->inRandomOrder()->take(10)->get();
        });

        // Refresh stock from DB
        foreach ($popular as $food) {
            $food->stock = Food::find($food->id)->stock;
        }

        // Remove popular foods with stock = 0
        $popular = $popular->filter(fn($food) => $food->stock > 0)->values();

        // Filter for search & price only (rating is handled later in PHP)
        $filters = function ($query) use ($searchQuery, $priceMax) {
            if ($searchQuery) {
                $query->where(function ($q) use ($searchQuery) {
                    $q->where('foods.name', 'like', '%' . $searchQuery . '%')
                        ->orWhereHas('restaurant', function ($q2) use ($searchQuery) {
                            $q2->where('name', 'like', '%' . $searchQuery . '%');
                        });
                });
            }

            if ($priceMax) {
                $query->where('foods.price', '<=', (int)$priceMax);
            }
        };

        // Load, filter, sort all in PHP
        $loadFoodsByCategory = function ($categoryId) use ($filters, $ratingMin, $sort) {
            $collection = Food::with('restaurant')
                ->where('category_id', $categoryId)
                ->where($filters)
                ->get();

            // Exclude foods with stock = 0
            $collection = $collection->filter(fn($food) => $food->stock > 0);

            // Filter by ratingMin (in PHP, not SQL)
            if ($ratingMin) {
                $collection = $collection->filter(function ($food) use ($ratingMin) {
                    return $food->restaurant->avg_rating >= (float)$ratingMin;
                });
            }

            // Sort by popular or nearby
            if ($sort === 'popular') {
                $collection = $collection->sortByDesc(fn($food) => $food->restaurant->avg_rating ?? 0);
            } elseif ($sort === 'nearby') {
                $collection = $collection->sortBy(fn($food) => $food->restaurant->distance ?? PHP_INT_MAX);
            }

            return $collection->values(); // Reset collection keys
        };

        $mainCourses = $loadFoodsByCategory(1);
        $desserts    = $loadFoodsByCategory(2);
        $drinks      = $loadFoodsByCategory(3);
        $snacks      = $loadFoodsByCategory(4);

        return view('foods', compact('popular', 'mainCourses', 'desserts', 'snacks', 'drinks'));
    }


    public function downloadTemplate()
    {
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="food_upload_template.csv"',
        ];

        // Sesuaikan kolom dengan migrasi dan kebutuhan
        $columns = ['name', 'description', 'price', 'stock', 'exp_datetime', 'category_name', 'status', 'image_url'];

        // Sesuaikan data contoh
        $exampleData = [
            'Pizza Margherita',
            'Pizza klasik Italia',
            '55000',
            '20',
            '2025-12-31 23:59:00',
            'Main Course',
            'Available',
            'pizza.jpg'
        ];

        $callback = function () use ($columns, $exampleData) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fputcsv($file, $exampleData);
            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }

    public function processZipUpload(ProcessZipUploadRequest $request)
    {
        ini_set('max_execution_time', 300);

        $request->validate([
            'zip_file' => 'required|file|mimes:zip|max:20480',
        ]);

        $restaurant = Auth::user()->restaurant;
        if (!$restaurant) {
            return back()->with('error', 'Restaurant data not found for this user.');
        }

        $zipFile = $request->file('zip_file');
        $zip = new ZipArchive;

        $tempDir = 'temp/' . Str::uuid();
        Storage::disk('local')->makeDirectory($tempDir);
        $tempPath = Storage::disk('local')->path($tempDir);

        if ($zip->open($zipFile->getRealPath()) === TRUE) {
            $zip->extractTo($tempPath);
            $zip->close();

            $csvFile = null;
            foreach (File::files($tempPath) as $file) {
                if (strtolower($file->getExtension()) === 'csv') {
                    $csvFile = $file;
                    break;
                }
            }

            // dd($tempPath);

            if (!$csvFile) {
                File::deleteDirectory($tempPath);
                return back()->with('error', 'CSV file not found in ZIP.');
            }

            $result = $this->processCsv($csvFile, $tempPath, $restaurant);
        } else {
            return back()->with('error', 'Failed to open ZIP file.');
        }

        File::deleteDirectory($tempPath);

        $statusMessage = "CSV processed: " . $result['added'] . " new items added, " . $result['updated'] . " items updated.";

        if (!empty($result['errors'])) {
            return redirect()->back()
                ->with('status', $statusMessage) // Diubah ke 'status'
                ->with('import_errors', $result['errors']);
        }

        return redirect()->back()->with('status', $statusMessage); // Diubah ke 'status'
    }

    private function processCsv($csvFile, $tempPath, $restaurant)
    {
        $itemsAdded = 0;
        $itemsUpdated = 0;
        $errors = [];
        $rowNumber = 1;

        $delimiter = ';';
        $fileHandle = fopen($csvFile->getRealPath(), 'r');
        $header = array_map('strtolower', fgetcsv($fileHandle, 0, $delimiter));
        if (isset($header[0]) && strpos($header[0], "\xef\xbb\xbf") === 0) {
            $header[0] = substr($header[0], 3);
        }

        while (($row = fgetcsv($fileHandle, 0, $delimiter)) !== FALSE) {
            $rowNumber++;
            if (!array_filter($row) || count($header) !== count($row)) {
                continue;
            }

            $data = array_combine($header, $row);
            $foodName = trim($data['name'] ?? null);
            $status = trim($data['status'] ?? 'Available');

            $validStatuses = ['Available', 'Out of Stock'];
            if (!in_array($status, $validStatuses)) {
                $errors[] = "Row {$rowNumber}: Invalid status '{$status}'. Please use 'Available' or 'Out of Stock'.";
                continue;
            }

            if (!$foodName) {
                continue;
            }

            $existingFood = Food::where('restaurant_id', $restaurant->id)
                ->where('name', $foodName)
                ->first();

            $expDateTime = null;
            if (!empty($data['exp_datetime'])) {
                try {
                    $expDateTime = Carbon::createFromFormat('d/m/Y H:i', $data['exp_datetime'])->format('Y-m-d H:i:s');
                } catch (\Exception $e) {
                    $expDateTime = null;
                }
            }

            if ($existingFood) {
                $existingFood->stock += (int)($data['stock'] ?? 0);
                $existingFood->price = $data['price'] ?? $existingFood->price;
                $existingFood->description = $data['description'] ?? $existingFood->description;
                $existingFood->status = $status;
                if ($expDateTime) {
                    $existingFood->exp_datetime = $expDateTime;
                }
                $existingFood->save();
                $itemsUpdated++;
            } else {
                $categoryName = $data['category_name'] ?? null;
                $category = $categoryName ? Category::where('name', trim($categoryName))->first() : null;

                $imageName = trim($data['image_url'] ?? '');
                $finalImagePath = null;
                if ($imageName && File::exists($tempPath . '/' . $imageName)) {
                    $restaurantSlug = Str::slug($restaurant->name, '_');
                    $foodSlug = Str::slug($foodName);
                    $extension = pathinfo($imageName, PATHINFO_EXTENSION);
                    $targetDirectory = "food_images/{$restaurantSlug}";
                    $newImageName = "{$foodSlug}-" . Str::random(5) . ".{$extension}";
                    $finalImagePath = Storage::disk('public')->putFileAs($targetDirectory, new IlluminateFile($tempPath . '/' . $imageName), $newImageName);
                }
                
                // dd('test');x

                Food::create([
                    'restaurant_id' => $restaurant->id,
                    'category_id'   => $category ? $category->id : null,
                    'name'          => $foodName,
                    'description'   => $data['description'] ?? null,
                    'price'         => $data['price'] ?? 0,
                    'stock'         => (int)($data['stock'] ?? 0),
                    'exp_datetime'  => $expDateTime,
                    'status'        => $status,
                    'image_url'     => $finalImagePath,
                ]);
                $itemsAdded++;
            }
        }

        fclose($fileHandle);

        return ['added' => $itemsAdded, 'updated' => $itemsUpdated, 'errors' => $errors];
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
