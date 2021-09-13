<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.login');
    }
    public function login_auth(Request $r)
    {
        $r->validate(['email'=>'required','pass'=>'required']);
        $email=$r->input('email');
        $pass=$r->input('pass');

        $auth=admin::where(['email'=>$email])->first();
        if($auth)
        {
            if(Hash::check($pass,$auth->pass))
            {
             session()->put('admin_login',true);
             session()->put('admin_id',$auth->id);
             
             return redirect('admin/dashboard');
            }
            else
            {
                session()->flash('status','Enter Correct Password!');
                return redirect('admin');
            }
            // session()->put('admin_login',true);
            // return redirect('admin/dashboard');
        }
        else
        {
         session()->flash('status','Please check your Credentials!');
            return redirect('admin');
        }


    }
    public function admin_logout()
    {
     session()->forget('admin_login');
     return redirect('admin');
    }
  
}
