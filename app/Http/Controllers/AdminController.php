<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function showDashboard(){
        return view('dashboard');
    }
}
