<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    /**
     * 
     * 
     *
     */
    public function dashboard(){
        return view('admin.index');
    }
    
    /**
     * 
     * 
     * 
     */
    public function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * 
     * 
     * 
     */
    public function login(){
        return view('admin.login');
    }
}
