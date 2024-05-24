<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Login and register form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Login function
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // register function
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    // Change password form
    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }

    // Change password function
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = Auth::user();

        if (!\Hash::check($request->old_password, $user->password)) {
            return back()->withErrors([
                'old_password' => 'The provided password does not match our records.',
            ]);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('home');
    }

    // logout function
    public function logout()
    {
        Auth::logout();

        return redirect()->route('user.login');
    }

    // delete user
    public function delete($id)
    {
        User::destroy($id);

        return redirect()->route('user.login');
    }

}
