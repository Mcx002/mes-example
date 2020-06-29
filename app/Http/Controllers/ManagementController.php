<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementController extends Controller
{
    //
    public function index(){
        return view('management.home');
    }
    public function workorder(){
        return view('management.mng001_workorder');
    }
    public function bom(){
        return view('management.mng002_bom');
    }
    public function leadtime(){
        return view('management.mng003_leadtime');
    }
    public function routing(){
        return view('management.mng004_routing');
    }
    public function line(){
        return view('management.mng005_line');
    }
    public function op(){
        return view('management.mng006_op');
    }
    public function part(){
        return view('management.mng007_part');
    }
    public function model(){
        return view('management.mng008_model');
    }
    public function size(){
        return view('management.mng009_size');
    }
    public function transaction(){
        return view('management.mng010_transaction');
    }
    public function defect(){
        return view('management.mng011_defect_transaction');
    }
    public function transaction_info(){
        return view('management.mng012_transaction_info');
    }
    public function transaction_defect_info(){
        return view('management.mng013_transaction_defect_info');
    }
    public function wip_info(){
        return view('management.mng014_wip_info');
    }
}
