<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Validators\ValidatorRules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        return view('register');
    }
    public function action_register(Request $request)
    {
        try {
            $validator = ValidatorRules::registerRules($request->all());
            if ($validator->fails()) {
                return redirect('/register')->withErrors($validator)->withInput();
            }
            $password = $request->password;
            $password_confirm = $request->password_confirm;
            if ($password === $password_confirm) {
                $data = $request->except('password_confirm');
                $data['password'] = Hash::make($request->password);
                User::registerUser($data);
                return redirect('/login')->with('success', 'Silahkan Login');
            } else {
                return redirect('/register')->with('failed', 'Terjadi Kesalahan');
            }
        } catch (\Exception $e) {
            return redirect('/register')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
        }
    }
    public function login()
    {
        return view('login');
    }
    public function action_login(Request $request)
    {
        $validator = ValidatorRules::loginRules($request->all());
        if ($validator->fails()) {
            return redirect('/login')->withErrors($validator)->withInput();
        }
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard')->with('success', 'Selamat Datang ' . Auth::user()->name);
        } else {
            return redirect('/login')->with('failed', 'Username Or Password Wrong!');
        }
    }
    public function action_logout(Request $request)
    {
        Auth::logout();
        if (Auth::check()) {
            return redirect('/dashboard')->with('failed', 'terjadi kesalahan');
        } else {
            return redirect('/login')->with('success', 'Anda berhasil Logout');
        }
    }
}
