<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if ($username == 'admin' && $password == 'admin2026') {
            return view('WKMonitoring');
        } 
        else {
            return back()->with('error', 'Invalid username or password');
        }
    }

    public function logout()
    {
        return view('index');
    }
}
