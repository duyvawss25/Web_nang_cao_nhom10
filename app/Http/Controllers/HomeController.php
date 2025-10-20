<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // ...
    public function index()
    {
        // Trả về view trang chủ index.blade.php
        return view('index'); 
    }
}

