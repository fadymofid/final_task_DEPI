<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the login form for web users
    public function showLoginForm()
    {
        return view('login'); // Blade template for the login form
    }

    // Handle login for web users
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('phone_number', 'password'))) {
            // Redirect based on user type
            if (auth()->user()->type === 'client') {
                return redirect()->route('notifications.index');
            } elseif (auth()->user()->type === 'admin') {
                return redirect()->route('users.index');
            } else {
                return redirect()->back()->withErrors(['phone_number' => 'User type not recognized.']);
            }
        }

        // If unsuccessful, return back with an error
        return redirect()->back()->withErrors(['phone_number' => 'Invalid credentials.']);
    }

    // Handle login for API users
    public function apiLogin(LoginRequest $request)
    {
        $credentials = ['phone_number' => $request->phone_number, 'password' => $request->password];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken($user['phone_number'])->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
            ], Response::HTTP_OK);
        }

        // Log the credentials for debugging
        \Log::info('Login attempt failed', $credentials);

        return response()->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
    }

    // Handle logout for web users
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'Successfully logged out!');
    }

    // Handle logout for API users
    public function apiLogout(Request $request)
    {
        $request->user()->tokens()->delete(); // Assuming Sanctum or Passport

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out',
        ]);
    }
}
