<?php

namespace App\Http\Controllers;

use App\Ad;
use App\State;
use App\Htype;
use App\User;
use App\Volunteer;
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
            $volunteers = Volunteer::where('status',1)->orderBy('id','DESC')->get();
            $states = State::where('status',1)->get();
            $htypes = Htype::where('status',1)->get();
            $users = User::where('status',1)->get();
            return view('admin.dashboard')->with('ads',$ads)->with('htypes',$htypes)->with('states',$states)->with('users',$users)->with('volunteers',$volunteers);
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

    public function volunteersPage()
    {
        if(auth()->user()->admin == 1 || auth()->user()->admin == 2)
        {
            $volunteers = Volunteer::where('status',1)->orderBy('id','DESC')->get();
            return view('admin.users.volunteers-page')->with('volunteers',$volunteers);
        }
    }

    public function needs($id)
    {
        if(auth()->user()->admin == 1)
        {
            $title = $id==1?"جديدة":($id==2?"مكتملة":($id==3?"في انتظار المتطوع":"في انتظار التأكيد"));
            $ads = Ad::where('status',$id)->orderBy('id','DESC')->paginate(50);
            return view('index-admin')->with('ads',$ads)->with('title',$title);
        }
        elseif(auth()->user()->admin == 2)
        {
            $title = $id==1?"جديدة":($id==2?"مكتملة":($id==3?"في انتظار المتطوع":"في انتظار التأكيد"));
            $ads = Ad::where('status',$id)->orderBy('id','DESC')->paginate(50);
            return view('index-admin')->with('ads',$ads)->with('title',$title);
        }
        elseif(auth()->user()->admin == 3)
        {
            $ads = Ad::where('status',3)->where('assigned_by',auth()->user()->user_id)->orderBy('id','DESC')->paginate(50);
            return view('index-admin')->with('ads',$ads)->with('title',"قيد الانتظار");
        }
    }

    public function reserved()
    {
        if(auth()->user()->admin == 1)
        {
            $ads = Ad::where('status',5)->orderBy('id','DESC')->paginate(50);
            return view('reserved')->with('ads',$ads)->with('title','الحالات المحجوزة');
        }
        elseif(auth()->user()->admin == 2)
        {
            $ads = Ad::where('status',5)->where('assigned_by',auth()->user()->id)->orderBy('id','DESC')->paginate(50);
            return view('reserved')->with('ads',$ads)->with('title','الحالات المحجوزة');
        }
        elseif(auth()->user()->admin == 3)
        {
            $ads = Ad::where('status',5)->where('updated_by',auth()->user()->id)->orderBy('id','DESC')->paginate(50);
            return view('reserved')->with('ads',$ads)->with('title','الحالات المحجوزة');
        }
    }

    public function completed()
    {
        if(auth()->user()->admin == 1)
        {
            $ads = Ad::where('status',2)->orderBy('id','DESC')->paginate(50);
            return view('reserved')->with('ads',$ads)->with('title','الحالات المكتملة');
        }
        elseif(auth()->user()->admin == 2)
        {
            $ads = Ad::where('status',2)->where('assigned_by',auth()->user()->id)->orderBy('id','DESC')->paginate(50);
            return view('reserved')->with('ads',$ads)->with('title','الحالات المكتملة');
        }
        elseif(auth()->user()->admin == 3)
        {
            $ads = Ad::where('status',2)->where('updated_by',auth()->user()->id)->orderBy('id','DESC')->paginate(50);
            return view('reserved')->with('ads',$ads)->with('title','الحالات المكتملة');
        }
    }

    public function users($id)
    {
        if(auth()->user()->email == "0921003398" || auth()->user()->email == "0923734194" || 
							auth()->user()->email == "0920996316" || auth()->user()->email == "0110012620" ||
							auth()->user()->email == "0925687117")
        {
            $users = User::where('status',1)->where('admin',$id)->get();
            return view('admin.users.index')->with('users',$users)->with('type',$id);
        }
        elseif(auth()->user()->admin == 1)
        {
            if($id==1){
                $users = User::where('status',1)->where('id',auth()->user()->id)->get();
            }elseif($id==2){
                $users = User::where('status',1)->where('user_id',auth()->user()->id)->get();
            }else{
                $users = User::where('status',1)->where('admin',$id)->get();
            }
            
            return view('admin.users.index')->with('users',$users)->with('type',$id);
        }
        elseif(auth()->user()->admin == 2)
        {
            $users = User::where('status',1)->where('admin',3)->where('user_id',auth()->user()->id)->get();
            return view('admin.users.index')->with('users',$users)->with('type',3);
        }
        elseif(auth()->user()->admin == 3)
            return redirect(route('needs',3));
    }
}
