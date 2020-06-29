<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementKrController extends Controller
{
    //
    public function index(){
        return view('kr.management.home');
    }
    public function workorder(){
        return view('kr.management.mng001_workorder');
    }
    public function bom(){
        return view('kr.management.mng002_bom');
    }
    public function leadtime(){
        return view('kr.management.mng003_leadtime');
    }
    public function routing(){
        return view('kr.management.mng004_routing');
    }
    public function line(){
        return view('kr.management.mng005_line');
    }
    public function op(){
        return view('kr.management.mng006_op');
    }
    public function part(){
        return view('kr.management.mng007_part');
    }
    public function model(){
        return view('kr.management.mng008_model');
    }
    public function size(){
        return view('kr.management.mng009_size');
    }
    public function transaction(){
        return view('kr.management.mng010_transaction');
    }
    public function defect(){
        return view('kr.management.mng011_defect_transaction');
    }
    public function transaction_info(){
        return view('kr.management.mng012_transaction_info');
    }
    public function transaction_defect_info(){
        return view('kr.management.mng013_transaction_defect_info');
    }
    public function wip_info(){
        return view('kr.management.mng014_wip_info');
    }
}
