<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IssuanceController extends Controller
{
    public function index()
{
    return view('issuances.index');
}

}
