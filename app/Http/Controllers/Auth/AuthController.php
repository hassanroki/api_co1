<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Registration
    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            // Registration after direct login, so create token
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Registration successfully!',
                'token_type' => 'Bearer',
                'access_token' => $token,
                'data' => $user,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Registration Failed!',
                'errors' => $e->getMessage(),
            ], 422);
        }
    }

    // login
    public function login(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'string'],
            ]);

            $user = User::where('email', $data['email'])->first();
            if (!$user || !Hash::check($data['password'], $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            // On Device
            // $user->tokens()->delete();
            $maxDevice = 3;
            $activeTokenCount = $user->tokens()->count();

            // Max 3 Device
            // if ($activeTokenCount > $maxDevice) {
            //     return response()->json([
            //         'message' => 'Maximum device limit reached. Please logout from another device to login.',
            //     ], 403);
            // }

            // Oldest Token Delete
            if ($activeTokenCount >= $maxDevice) {
                $user->tokens()
                    ->orderBy('created_at')
                    ->limit(1)
                    ->delete();
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'User login successfully',
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], status: 422);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Server error',
            ], 500);
        }
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'User logout successfully!',
        ]);
    }
}
