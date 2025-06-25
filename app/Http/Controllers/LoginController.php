<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    public function login(){
        return view("login");
    }


    public function actionLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $crederntials = $request->only('email', 'password');
        if(Auth::attempt($crederntials)){
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Login successfully');
        }

        return back()->withErrors([
            'email' => 'Invalid Credential',
        ])->onlyInput('email');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
