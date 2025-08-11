<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            if ($role === 'admin') {
                return view('website.homeAdmin');
            }

            return view('website.home'); // fallback
        }

        return view('website.home'); // public visitors
    }
}
