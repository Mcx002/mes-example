<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.home');
    }
    public function user(){
        return view('admin.adm001_user');
    }
    public function defectmaster(){
        return view('management.mng015_defect_master');
    }
}
