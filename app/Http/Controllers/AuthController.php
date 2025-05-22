<?php

namespace App\Http\Controllers;

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

    public function login(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'username' => 'required|string|max:64',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        // If auth fails, show error
        throw ValidationException::withMessages([
            'credentials' => 'The provided credentials do not match our records.',
        ]);
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
