<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class usersRegisteredController extends Controller
{
    public function usersRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'password_confirmation' => Hash::make($request->password),
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'token' => $token
        ]);
    }


    public function loginUsers(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token
        ]);
    }

    public function logoutUsers(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully'
        ]);
    }


}
