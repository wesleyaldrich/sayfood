<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\RestaurantRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantAdminController extends Controller
{
    public function index()
    {
        $targetStatus = request()->query('status', 'operational');

        $restaurant_registrations = RestaurantRegistration::query()->where('status', $targetStatus)
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('admin-manage-restaurants', compact('restaurant_registrations'));
    }

    public function show($id)
    {
        $restaurant_registration = RestaurantRegistration::find($id);

        return view('admin-manage-restaurants-detail', compact('restaurant_registration'));
    }

    public function export($id)
    {
        // dd('diddy');
        // Get orders
        $orders = RestaurantRegistration::findOrFail($id)
            ->restaurant
            ->orders()
            ->get();

        // Generate CSV filename
        $filename = 'restaurant_orders_' . now()->format('Ymd_His') . '.csv';
        $filepath = 'tmp/' . $filename;

        if (!Storage::exists('tmp')) {
            Storage::makeDirectory('tmp');
        }

        $fullPath = Storage::path($filepath);
        $handle = fopen($fullPath, 'w');
        fputcsv($handle, [
            'No.',
            'Order ID',
            'Customer Name',
            'Status',
            'Total',
            'Date'
        ]);

        foreach ($orders as $index => $order) {
            fputcsv($handle, [
                $index + 1,
                $order->id ?? 'N/A',
                $order->customer->user->username ?? 'N/A',
                $order->status ?? 'N/A',
                number_format($order->total_price, 2) ?? 'N/A',
                $order->updated_at->format('Y-m-d'),
            ]);
        }

        fclose($handle);

        return Storage::download($filepath, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
