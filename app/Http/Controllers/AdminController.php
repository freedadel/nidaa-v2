<?php

namespace App\Http\Controllers;

use App\Ad;
use App\State;
use App\Htype;
use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin()
    {
        if(auth()->user()->admin == 1)
        {
            $ads = Ad::orderBy('id','DESC')->get();
            $states = State::where('status',1)->get();
            $htypes = Htype::where('status',1)->get();
            $users = User::where('status',1)->get();
            return view('admin.dashboard')->with('ads',$ads)->with('htypes',$htypes)->with('states',$states)->with('users',$users);
        }
        elseif(auth()->user()->admin == 2)
        {
            $ads = Ad::orderBy('id','DESC')->get();
            $states = State::where('status',1)->get();
            $htypes = Htype::where('status',1)->get();
            $users = User::where('status',1)->get();
            return view('admin.dashboard')->with('ads',$ads)->with('htypes',$htypes)->with('states',$states)->with('users',$users);
        }
        elseif(auth()->user()->admin == 3)
        {
            return redirect(route('needs',3));
        }
    }

    public function needs($id)
    {
        if(auth()->user()->admin == 1)
        {
            $title = $id==1?"جديدة":($id==2?"مكتملة":($id==3?"في انتظار المتطوع":"في انتظار التأكيد"));
            $ads = Ad::where('status',$id)->orderBy('id','DESC')->get();
            return view('index-admin')->with('ads',$ads)->with('title',$title);
        }
        elseif(auth()->user()->admin == 2)
        {
            $title = $id==1?"جديدة":($id==2?"مكتملة":($id==3?"في انتظار المتطوع":"في انتظار التأكيد"));
            $ads = Ad::where('status',$id)->orderBy('id','DESC')->get();
            return view('index-admin')->with('ads',$ads)->with('title',$title);
        }
        elseif(auth()->user()->admin == 3)
        {
            $ads = Ad::where('status',3)->where('assigned_by',auth()->user()->user_id)->orderBy('id','DESC')->get();
            return view('index-admin')->with('ads',$ads)->with('title',"قيد الانتظار");
        }
    }

    public function users($id)
    {
        if(auth()->user()->admin == 1)
        {
            $users = User::where('status',1)->where('admin',$id)->get();
            return view('admin.users.index')->with('users',$users)->with('type',$id);
        }
        elseif(auth()->user()->admin == 2)
        {
            $users = User::where('status',1)->where('admin',3)->where('user_id',auth()->user()->id)->get();
            return view('admin.users.index')->with('users',$users)->with('type',3);
        }
        elseif(auth()->user()->admin == 3)
        return view('admin.index');
    }
}
