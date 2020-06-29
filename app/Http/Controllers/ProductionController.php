<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductionController extends Controller
{
    //
    public function index(){
        return view('production.home');
    }
    public function production_info(){
        return view('production.pdt001_production_info');
    }
}
