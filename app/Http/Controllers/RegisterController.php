<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RegisterController extends Controller
{
    // Show the registration form (web)
    public function showRegistrationForm()
    {
        return view('auth.register'); // Ensure this Blade file exists
    }

    // Handle registration for both web and API
    public function register(RegisterRequest $request)
    {
        // Validate the input (already validated by RegisterRequest)
        $validatedData = $request->validated();

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'phone_number' => $validatedData['phone_number'],
            'password' => Hash::make($validatedData['password']),
            'type' => 'client', // Adjust as needed
        ]);

        return redirect()->route('login');
    }
    public function apiRegister(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['name'],
            'phone_number' => $validatedData['phone_number'],
            'password' => Hash::make($validatedData['password']),
            'type' => 'client', // Adjust as needed
        ]);

        return response()->json([
            'message' => 'Registration successful!',
            'user' => $user,
        ], Response::HTTP_CREATED);
    }
}
