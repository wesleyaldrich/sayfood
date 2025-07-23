<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;
use App\Models\RestaurantRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function reject($id)
    {
        $registration = RestaurantRegistration::findOrFail($id);
        $registration->status = 'rejected';
        $registration->save();

        // Notify the user via email message
        Mail::send([], [], function ($message) use ($registration) {
            $message->to($registration->email)
                ->subject('Sayfood | Your Restaurant Application to Sayfood')
                ->html("
                <h2>Information about your restaurant application to Sayfood!</h2>

                <p>Hi! We are sorry to inform you, unfortunately your application:</p>
                <ul>
                    <li>Restaurant Name: <strong>{$registration->name}</strong></li>
                    <li>Restaurant Address: <strong>{$registration->address}</strong></li>
                </ul>
                <p>has been rejected by our admin team.</p>
                <p><a href='" . url('/register-restaurant') . "'>Click here to submit another application!</a></p>
            ");
        });

        return redirect()->route('show.manage.restaurants')->with('status', 'Restaurant registration rejected successfully.');
    }

    public function approve($id)
    {
        // Find the restaurant registration by ID
        $registration = RestaurantRegistration::findOrFail($id);

        // Create a new user for the restaurant with random username
        $randomStr = Str::uuid();
        $user = User::create([
            'username' => 'restaurant_' . $randomStr,
            'email' => $registration->email,
            'password' => bcrypt('restaurant_' . $randomStr),
            'role' => 'restaurant',
        ]);

        $user->two_factor_verified = 1;
        $user->save();

        // Create a new restaurant record
        $newRestaurant = Restaurant::create([
            'user_id' => $user->id,
            'name' => $registration->name,
            'address' => $registration->address,
        ]);

        // Update the registration
        $registration->status = 'operational';
        $registration->restaurant_id = $newRestaurant->id;
        $registration->save();

        // Notify the user via email message
        Mail::send([], [], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Sayfood | Your Restaurant Account Credentials')
                ->html("
                <h2>Welcome to Sayfood!</h2>

                <p>Your credentials are:</p>
                <ul>
                    <li>Username: <strong>{$user->username}</strong></li>
                    <li>Password: <strong>{$user->username}</strong></li>
                </ul>
                <p><a href='" . url('/login-restaurant') . "'>Click here to log in</a></p>
            ");
        });

        Log::channel('auth')->info('Restaurant registration approved.', [
            'restaurant_name' => $registration->name,
            'admin_id' => Auth::id()
        ]);

        return redirect()->route('show.manage.restaurants')->with('status', 'Restaurant registration approved successfully.');
    }
}
