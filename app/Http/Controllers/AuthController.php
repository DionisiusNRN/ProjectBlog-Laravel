<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{
    public function login() // menampilkan semua
    {
        return view("auth.login");
    }

    public function authenticate(Request $request) {
        $credentials = $request->only("email","password");
        // Auth itu library dari jetstring (bawaan)
        if(Auth::attempt($credentials)) {
            return redirect("posts");
        } else {
            return redirect("login")->with("error_message","Wrong email or password");
        }
    }

    public function logout() {
        Session::flush();
        Auth::logout();

        return redirect("login");
    }

    public function register_form() {
        return view("auth.register");
    }

    public function register(Request $request) {
        $request->validate([
            "name"      => "required",
            "email"     => "required|email|unique:users",
            "password"  => "required|min:6|confirmed" // password == password_confirmation
        ]);

        User::create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => Hash::make($request->input('password')), // password yg disimpan itu dalam bentuk Hash
        ]);

        return redirect('login');
    }
}
