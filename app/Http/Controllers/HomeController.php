<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        return view('home.index', compact('user'));
    }

    public function nsl()
    {
        return view('home.nsl_detail');
    }

    public function myip() 
    {
        return view('home.myip');
    }

    public function profile() 
    {
        return view('home.profile');
    }
}


