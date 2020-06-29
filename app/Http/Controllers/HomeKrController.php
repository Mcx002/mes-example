<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class HomeKrController extends Controller
{
    //
    public function index()
    {
        return view('home');
    }
    public function checklevel(){
        if(Session::get('level')=="1"){
            return redirect()->route('kr_management_home');
        }else if(Session::get('level')=="2"){
            return redirect()->route('kr_qualitycontrol_home');
        }else if(Session::get('level')=="3"){
            return redirect()->route('kr_production_home');
        }else{
            return redirect()->route('kr_admin_home');
        }
    }
}
