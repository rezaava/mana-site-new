<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin_dashboard');
            }
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);

        // تلاش برای ورود با ایمیل یا نام کاربری
        $field = filter_var($request->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (Auth::attempt([$field => $request->identifier, 'password' => $request->password])) {
            $request->session()->regenerate();

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'redirect' => route('home'),
                ]);
            }

            return redirect()->intended('/admin/2');
        }

        if ($request->wantsJson()) {
            return response()->json([
                'errors' => ['identifier' => ['نام کاربری یا رمز عبور اشتباه است.']],
            ], 422);
        }

        return back()->withErrors(['identifier' => 'نام کاربری یا رمز عبور اشتباه است.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}