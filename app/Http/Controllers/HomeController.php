<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\IP;

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

        $registered_ips_query = IP::whereNotNull('user_id')->with('user')->get();

        $registeredips = array();
        $ipUsers = array();
        foreach ($registered_ips_query as $ip) {
            array_push($registeredips, $ip->id);
            array_push($ipUsers, $ip->user->name);
        }

        return view('home.index', compact('user', 'registeredips', 'ipUsers'));
    }


    public function nsl()
    {
        $user = auth()->user();

        $ips = IP::with('user')->get();

        $all_user = User::all();

        return view('home.nsl_detail', compact('user', 'ips', 'all_user'));
    }


    public function myip() 
    {
        $user = auth()->user();

        $ips = IP::where('user_id', $user->id)->with('user')->get();

        return view('home.myip', compact('user', 'ips'));
    }


    public function profile() 
    {
        return view('home.profile');
    }
}


