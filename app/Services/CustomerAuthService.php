<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CustomerLoginRequest;
use App\Http\Requests\CustomerRegisterRequest;

class CustomerAuthService
{
    /**
     * Attempt to login the customer.
     *
     * @param CustomerLoginRequest $request
     * @return bool
     */
    public function login(CustomerLoginRequest $request): bool
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        // Find user to check role
        $user = User::where('email', $request->email)->first();

        // Allow both customer and driver to login from frontend
        if ($user && in_array($user->role, ['customer', 'driver'])) {
            return Auth::attempt($credentials, $request->boolean('remember'));
        }

        return false;
    }

    /**
     * Register a new customer or claim an existing guest account.
     *
     * @param CustomerRegisterRequest $request
     * @return User
     */
    public function register(CustomerRegisterRequest $request): User
    {
        $user = User::where('phone', $request->phone)->where('role', 'customer')->first();

        if ($user && $user->email === null) {
            // Claim existing guest account
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            // Create new account
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'customer',
            ]);
        }

        Auth::login($user);

        return $user;
    }

    /**
     * Logout the customer.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function logout($request): void
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
