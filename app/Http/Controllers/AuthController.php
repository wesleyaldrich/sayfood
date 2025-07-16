<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\RestaurantRegistration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

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

        $twofactorCode = random_int(100000, 999999);
        $validatedData['two_factor_code'] = $twofactorCode;

        $currentUser = User::create($validatedData);

        Customer::create([
            'user_id' => $currentUser->id
        ]);

        Auth::login($currentUser);

        // Send the two-factor code to the user via email message
        Mail::raw("Your two-factor authentication code is: $twofactorCode", function ($message) use ($currentUser) {
            $message->to($currentUser->email)
                    ->subject('Sayfood | Two-Factor Authentication Code');
        });

        return redirect()->route('twofactor.verif');
    }

    public function twoFactorVerification()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('show.register');
        }

        $currentUser = Auth::user();

        // Ensure $currentUser is a fresh Eloquent model instance
        if ($currentUser) {
            $currentUser = User::find($currentUser->id);
        }

        // Check if the user has a two-factor code
        if (!$currentUser || !$currentUser->two_factor_code) {
            return redirect()->route('show.register');
        }

        return view('two-factor');
    }

    public function twoFactorSubmit(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'otp' => 'required|integer|digits:6',
        ]);

        # make sure otp is an integer
        $validatedData['otp'] = (int) $validatedData['otp'];

        $currentUser = Auth::user();

        // Ensure $currentUser is a fresh Eloquent model instance
        if ($currentUser) {
            $currentUser = User::find($currentUser->id);
        }

        // Check if the two-factor code matches
        if ($currentUser && $currentUser->two_factor_code === $validatedData['otp']) {
            // Remove the two-factor code from the database
            $currentUser->two_factor_code = null;
            $currentUser->two_factor_verified = true; // Set the verification timestamp
            $currentUser->save();

            // Log the user in (if not already)
            Auth::login($currentUser);

            return redirect()->route('home')->with('status', 'Two-factor authentication successful.');
        } else {
            throw ValidationException::withMessages([
                'otp' => 'The provided two-factor code is incorrect.',
            ]);
        }
    }

    public function twoFactorResend(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('show.register');
        }

        $currentUser = Auth::user();

        // Ensure $currentUser is a fresh Eloquent model instance
        if ($currentUser) {
            $currentUser = User::find($currentUser->id);
        }

        // Generate a new two-factor code
        $twofactorCode = random_int(100000, 999999);
        $currentUser->two_factor_code = $twofactorCode;
        $currentUser->save();

        // Send the new two-factor code to the user via email message
        Mail::raw("Your two-factor authentication code is: $twofactorCode", function ($message) use ($currentUser) {
            $message->to($currentUser->email)
                    ->subject('Sayfood | Two-Factor Authentication Code');
        });

        return redirect()->route('twofactor.verif')->with('status', 'A new two-factor authentication code has been sent to your email.');
    }

    public function registerRestaurant(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:320|unique:users,email',
        ]);

        RestaurantRegistration::create($validatedData);

        return redirect()->route('home')->with('status', 'Restaurant registration successful. We will contact your email soon.');
    }

    public function approveRegistration($id)
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
        Restaurant::create([
            'user_id' => $user->id,
            'name' => $registration->name,
            'address' => $registration->address,
        ]);

        // Update the status to be 'approved'
        $registration->status = 'approved';
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
            if (Auth::user()->role === 'customer' || Auth::user()->role === 'admin') {
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
                return redirect()->route('restaurant-home');
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
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function profile()
    {
        // get the user of the current session
        $currentUser = Auth::user();

        if (!$currentUser){
            return redirect()->route('selection-login');
        }

        if ($currentUser->role === 'customer' || $currentUser->role === 'admin'){
            return view('profile-customer', ['user' => $currentUser]);
        }
        else if ($currentUser->role === 'restaurant'){
            return view('profile-restaurant', ['user' => $currentUser]);
        }

        // Unexpected role - throw an error
        return redirect()->back()->withErrors(
            ['error' => 'Error: unexpected user role.']
        );
    }

    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:64',
            'dob' => [
                'nullable',
                'date',
                'before_or_equal:' . Carbon::now()->subYears(18)->toDateString(), // at least 18
                'after_or_equal:' . Carbon::now()->subYears(125)->toDateString(), // at most 125
            ],
            'address' => 'nullable|string|max:200'
        ]);

        $currentUser = Auth::user();

        if ($currentUser) {
            $currentUser = User::find($currentUser->id);

            $currentUser->username = $validatedData['username'];
            $currentUser->customer->dob = $validatedData['dob'];
            $currentUser->customer->address = $validatedData['address'];
            $currentUser->save();
            $currentUser->customer->save();
        }

        return redirect()->back()->with('status', 'Profile successfully updated!');
    }

    public function updateProfileRestaurant(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:64',
            'restaurant_name' => 'required|string|max:64',
            'address' => 'nullable|string|max:200'
        ]);

        $currentUser = Auth::user();

        if ($currentUser) {
            $currentUser = User::find($currentUser->id);

            $currentUser->username = $validatedData['username'];
            $currentUser->restaurant->name = $validatedData['restaurant_name'];
            $currentUser->restaurant->address = $validatedData['address'];
            $currentUser->save();
            $currentUser->restaurant->save();
        }

        return redirect()->back()->with('status', 'Profile successfully updated!');
    }

    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $currentUser = Auth::user();

        if ($currentUser) {
            $currentUser = User::find($currentUser->id);

            $image = $request->file('profile_image');
            $imageName = 'profile_' . $currentUser->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            // $imagePath = $image->storeAs('public/profile_images', $imageName);
            $imagePath = $image->storeAs('profile_images', $imageName, 'public');

            // Save the image path to the user (assuming a 'profile_image' column exists)
            $currentUser->profile_image = 'profile_images/' . $imageName;
            $currentUser->save();

            return redirect()->route('profile')->with(
                'status', 'Successfully updated profile image!'
            );
        }

        return redirect()->route('profile')->withErrors([
            ['error' => 'Error: failed to change profile image.']
        ]);
    }
    
    public function redirectToRestaurantLogin(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.login.restaurant');
    }

    public function redirectToCustomerLogin(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.login');
    }

    public function deleteAccount(Request $request)
    {
        $currentUser = Auth::user();
        $currentUser = User::find($currentUser->id);
        $currentUser->delete();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home');
    }
}
