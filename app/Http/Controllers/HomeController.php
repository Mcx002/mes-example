<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function checklevel(){
        if(Session::get('level')=="1"){
            return redirect()->route('management_home');
        }else if(Session::get('level')=="2"){
            return redirect()->route('qualitycontrol_home');
        }else if(Session::get('level')=="3"){
            return redirect()->route('production_home');
        }else{
            return redirect()->route('admin_home');
        }
    }
}
