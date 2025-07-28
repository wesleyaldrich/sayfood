<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Report;
use App\Models\SuspendedRestaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'Pending');
        $search = $request->query('query');

        $reports = Report::with(['customer.user', 'restaurant'])
            ->where('status', $status);

        if ($search) {
            $reports->where(function ($q) use ($search) {
                $q->whereHas('customer.user', function ($userQuery) use ($search) {
                    $userQuery->where('username', 'like', "%{$search}%");
                })->orWhereHas('restaurant', function ($restoQuery) use ($search) {
                    $restoQuery->where('name', 'like', "%{$search}%");
                });
            });
        }

        $reports = $reports->paginate(10)->appends($request->query());

        return view('report-resto-admin', compact('reports'));
    }

    public function show(Report $report)
    {
        return view('report-resto-detail', compact('report'));
    }

    public function suspend(Report $report)
    {
        $restaurant = $report->restaurant;
        $user = $restaurant->user;

        $suspended_restaurant = SuspendedRestaurant::create([
            'id' => $restaurant->id,
            'name' => $restaurant->name,
            'email' => $user->email,
            'address' => $restaurant->address,
            'description' => $restaurant->description,
            'image_url_resto' => $restaurant->image_url_resto
        ]);

        Report::where('restaurant_id', $restaurant->id)->update([
            'status' => 'Resolved',
            'restaurant_id' => null,
            'suspended_restaurant_id' => $suspended_restaurant->id
        ]);
        
        $restaurant->delete();
        $user->delete();

        return redirect()->route('show.manage.reports')->with('status', 'Successfully suspend reported restaurant!');
    }

    public function safe(Report $report)
    {
        $report->update([
            'status' => 'Resolved'
        ]);

        return redirect()->route('show.manage.reports')->with('status', 'Successfully mark report as safe!');
    }

    public function store(Request $request)
    {
        $currentUser = Auth::user();

        // Validasi: user harus customer
        if (!$currentUser->customer) {
            return back()
                ->withErrors(['user' => 'Akun Anda tidak terdaftar sebagai customer.'])
                ->withInput();
        }

        // Validasi awal: restaurant_id harus valid
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);

        // Validasi khusus: salah satu harus diisi
        if (empty($request->description)) {
            return back()
                ->withErrors(['description' => 'Please select a reason or write a report.'])
                ->withInput();
        }

        // Simpan ke database
        Report::create([
            'restaurant_id' => $request->restaurant_id,
            'customer_id' => $currentUser->customer->id,
            'description' => $request->description,
        ]);

        return back()->with('report_success', 'Thank you! Your report has been submitted.   ');
    }
}
