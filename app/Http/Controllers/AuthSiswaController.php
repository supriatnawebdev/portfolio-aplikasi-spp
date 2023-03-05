<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthSiswaController extends Controller
{
    public function showForm(){
        return view('siswa.form');
    }

    public function checkLogin(Request $request){
        // dd($request);
        $request->validate([
            'nisn' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only(['nisn', 'password']);
        if (Auth::guard('siswa')->attempt($credentials)) {
            return redirect()->intended('/siswa/beranda')
                        ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }
}
