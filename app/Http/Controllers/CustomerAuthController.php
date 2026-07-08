<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CustomerLoginRequest;
use App\Http\Requests\CustomerRegisterRequest;
use App\Services\CustomerAuthService;

class CustomerAuthController extends Controller
{
    protected $authService;

    public function __construct(CustomerAuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('profile');
        }
        return view('auth.login');
    }

    public function login(CustomerLoginRequest $request)
    {
        if ($this->authService->login($request)) {
            $request->session()->regenerate();
            return redirect()->intended(route('profile'));
        }

        return back()->withErrors([
            'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('profile');
        }
        return view('auth.register');
    }

    public function register(CustomerRegisterRequest $request)
    {
        $this->authService->register($request);

        return redirect()->route('profile');
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);

        return redirect()->route('home');
    }
}
