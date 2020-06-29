<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MesUser;
use DB;

class AdminApiController extends Controller
{
    //
    public function users(){
        $data = MesUser::all();
        return response()->json($data);
    }
    public function adduser(Request $request){
        $data = MesUser::create([
            'emp_id'=>$request->emp_id,
            'name'=>$request->name,
            'password'=>$request->password,
            'level'=>$request->level,
        ]);
        // dd($request->emp_id);
        return response()->json(['id'=>$data->id]);
    }
    public function edituser(Request $request){
        MesUser::find($request->id)->update([
            'emp_id'=>$request->emp_id,
            'name'=>$request->name,
            'password'=>$request->password,
            'level'=>$request->level,
        ]);
        return response('success',200);
    }
    public function deleteuser($id){
        MesUser::find($id)->delete();
        return response('success',200);
    }
    public function option(){
        $data = DB::table('option')->first();
        return response()->json($data);
    }
    public function setcollapse($data){
        DB::table('option')->where('id',1)->update([
            'collapse'=>$data
        ]);
        return response('success',200);
    }
}
