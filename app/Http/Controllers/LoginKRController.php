<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\MesUser;

class LoginKRController extends Controller
{
    //
    
    public function login(){
        if(!Session::get('login')){
            return view('kr.auth.login');
        }else{
            return redirect()->route('kr_checklevel');
        }
        // Session::flush();
    }
    public function loginprocess(Request $request){
        $data = MesUser::where('emp_id',$request->emp_id)->first();
        if(isset($data)){
            if($data->password=="0000000"){
                if($request->password==$data->password){
                    Session::put('emp_id',$data->emp_id);
                    Session::put('name',$data->name);
                    Session::put('level',$data->level);
                    Session::put('login',TRUE);
                    return redirect()->route('kr_cnpassword');
                }else{
                    return redirect()->back()->withInput()->withErrors([
                        'id'=>'Wrong ID or Password'
                    ]);
                }
            }else{
                if($data->password===$request->password){
                    Session::put('emp_id',$data->emp_id);
                    Session::put('name',$data->name);
                    Session::put('level',$data->level);
                    Session::put('login',TRUE);
                    return redirect()->route('kr_checklevel');
                }else{
                    return redirect()->back()->withInput()->withErrors([
                        'id'=>'Wrong ID or Password'
                    ]);
                }
            }
        }else{
            return redirect()->back()->withInput()->withErrors([
                'id'=>'Wrong ID or Password'
            ]);
        }
        // return view('kr.auth.login');
    }
    public function logout()
    {
        Session::flush();
        return redirect()->route('kr_login')->with('alert','Kamu sudah logout');
    }
    public function cnpassword(){
        if(Session::has('login')){
            $data = MesUser::where('emp_id',Session::get('emp_id'))->first();
            if($data->password=="0000000"){
                return view('kr.auth.create_new_password');
            }else{
                if(Session::get('login')){
                    return redirect()->route('kr_checklevel');
                }
            }
        }else{
            return redirect()->route('kr_login');
        }
    }
    public function cnpasswordprocess(Request $request)
    {
        MesUser::where('emp_id',Session::get('emp_id'))->update(['password'=>$request->password]);
        return redirect()->route('kr_checklevel');
    }
}
