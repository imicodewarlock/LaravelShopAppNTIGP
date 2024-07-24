<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('dashboard.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', '=', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password))
            return redirect()->back()->with("error", "Username or password doesn't match");

        Session::put('user', [
            'id' => $user->id,
            'name' => $user->name,
            'role' => $user->role
        ]);

        return redirect()->route('dashboard.index');
    }

    public function logout(Request $request)
    {
        Session::flush();

        return redirect()->route('auth.login.show')->with("success", "You have been successfully logged out");
    }
}
