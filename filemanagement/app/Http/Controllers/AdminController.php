<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function loginAdmin()
    {
        if (auth()->check()) {
            return redirect()->to('admin/home');
        }
        return view('login');
    }

    public function postloginAdmin(Request $request)
    {
        $remember = $request->has('remember_me') ? true : false;

        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $remember)) {

            return redirect()->to('admin/home');
        } else {

            return view('login');
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->to('admin');
    }
}
