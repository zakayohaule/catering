<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('homepage.homepage');
    }
}
