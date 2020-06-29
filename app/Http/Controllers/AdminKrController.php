<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminKrController extends Controller
{
    //
    public function index(){
        return view('kr.admin.home');
    }
    public function user(){
        return view('kr.admin.adm001_user');
    }
    public function defectmaster(){
        return view('kr.management.mng015_defect_master');
    }
}
