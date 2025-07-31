<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function requestForm()
    {
        $currentUser = Auth::user();
        $email = '';

        if ($currentUser){
            $email = $currentUser->email;
        }

        return view('forgot-password', compact('email'));
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|max:320|exists:users,email']);

        // Create token
        $token = Str::random(32);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => Carbon::now(),
            ]
        );

        // Send email manually or use built-in notification
        $resetUrl = url('/reset-password/' . $token . '?email=' . urlencode($request->email));

        // Send reset link
        Mail::raw("Your password reset link is: $resetUrl", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Sayfood | Password Reset Link');
        });

        return back()->with('status', 'Password reset link sent to your email!');
    }

    public function resetForm($token, Request $request)
    {
        $email = $request->query('email');
        return view('reset-password', compact('token', 'email'));
    }

    public function resetPassword(PasswordResetRequest $request)
    {
        $request->validated();

        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$record || !Hash::check($request->token, $record->token)) {
            return back()->withErrors(['token' => 'Invalid or expired token']);
        }

        // Reset password
        $user = User::where('email', $request->email)->first();
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // Delete the token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect('/login')->with('status', 'Password has been reset!');
    }
}
