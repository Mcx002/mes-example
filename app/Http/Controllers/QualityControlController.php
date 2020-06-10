<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QualityControlController extends Controller
{
    //
    public function index(){
        return view('qualitycontrol.home');
    }
}
