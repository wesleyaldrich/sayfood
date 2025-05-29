<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RestaurantRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'username' => 'required|string|max:64',
            'email' => 'required|email|max:320|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $currentUser = User::create($validatedData);

        // Automatically log in the user after register
        Auth::login($currentUser);

        return redirect()->route('home');
    }

    public function registerRestaurant(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'email' => 'required|email|max:320|unique:users,email',
            ]);

            RestaurantRegistration::create($validatedData);

            return redirect()->route('home')->with('success', 'Restaurant registration successful. We will contact you soon.');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function approveRegistration($id)
    {
        // Find the restaurant registration by ID
        $registration = RestaurantRegistration::findOrFail($id);

        // Create a new user for the restaurant with random username
        $user = User::create([
            'username' => 'restaurant_' . $registration->id,
            'email' => $registration->email,
            'password' => bcrypt('restaurant_' . $registration->id),
            'role' => 'restaurant',
        ]);

        // Create a new restaurant record
        Restaurant::create([
            'user_id' => $user->id,
            'name' => $registration->name,
            'address' => $registration->address,
        ]);


        // Update the status to be 'approved'
        $registration->status = 'approved';
        $registration->save();

        // TO DO: send the restaurant an email with the login credentials

        return;
    }

    public function login(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'username' => 'required|string|max:64',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($validatedData)) {
            if (Auth::user()->role === 'customer') {
                $request->session()->regenerate();
                return redirect()->route('home');
            }

            Auth::logout();

            // show error
            throw ValidationException::withMessages([
                'credentials' => 'You do not have a customer account.',
            ]);
        }
        else {
            // If auth fails, show error
            throw ValidationException::withMessages([
                'credentials' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function loginRestaurant(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'username' => 'required|string|max:64',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($validatedData)) {
            if (Auth::user()->role === 'restaurant') {
                $request->session()->regenerate();
                return redirect()->route('home.restaurant');
            }

            Auth::logout();

            // show error
            throw ValidationException::withMessages([
                'credentials' => 'You do not have a restaurant account.',
            ]);
        }
        else {
            // If auth fails, show error
            throw ValidationException::withMessages([
                'credentials' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        // Invalidate the user's session
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.login');
    }
}
