<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        // Redirect to Google OAuth
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (Throwable $e) {
            return redirect()->route('show.login')->with('error', 'Failed to authenticate with Google.');
        }

        // Check if the user already exists in the database
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            Auth::login($existingUser);
        }
        else {
            $newUser = User::updateOrCreate(
                ['email' => $user->email],
                [
                    'username' => $user->name,
                    'password' => bcrypt(Str::random(16)),
                    'email_verified_at' => now(),
                    'two_factor_verified' => true
                ]
            );

            // Automatically log in the new user
            Auth::login($newUser);
        }

        return redirect()->route('home');
    }
}
