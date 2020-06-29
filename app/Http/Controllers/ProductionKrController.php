<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductionKrController extends Controller
{
    //
    public function index(){
        return view('kr.production.home');
    }
    public function production_info(){
        return view('kr.production.pdt001_production_info');
    }
}
