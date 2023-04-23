<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ad;
use App\State;
use App\Htype;

class HomeController extends Controller
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
    public function index()
    {
        $ads = Ad::where('status',1)->orderBy('id','DESC')->get();
        return view('index-admin')->with('ads',$ads)->with('title','كل الحالات');
    }

    public function getAdsByState($id)
    {
        $state = State::findorFail($id);
        $ads = Ad::where('status',1)->where('state_id',$id)->orderBy('id','DESC')->get();
        return view('index-admin')->with('ads',$ads)->with('title',$state->name);
    }

    public function getAdsByHtype($id)
    {
        $htype = Htype::findorFail($id);
        $ads = Ad::where('status',1)->where('htype_id',$id)->orderBy('id','DESC')->get();
        return view('index-admin')->with('ads',$ads)->with('title',$htype->name);
    }

    public function searchCase()
    {
        return view('search');
    }

    public function searchResult(Request $request)
    {
        if(!empty($request->case_id))
        {
            $ads = Ad::where('id',$request->case_id)->where('status',1)->get();
            return view('index-admin')->with('ads',$ads);
        }
    }

    public function dashboard()
    {
        $ads = Ad::orderBy('id','DESC')->get();
        $states = State::where('status',1)->get();
        $htypes = Htype::where('status',1)->get();
        return view('dashboard')->with('ads',$ads)->with('htypes',$htypes)->with('states',$states);
    } 
    public function done($id)
    {
        $ad = Ad::findorFail($id);
        $old = $ad->status;
        if(auth()->user()->admin !=3)
        {
            $ad->status = 2;
            if(empty($ad->completed_by))
            $ad->completed_by = auth()->user()->id;
            
            $ad->confirmed_by = auth()->user()->id;
        }
        else
        {
            $ad->status = 4;
            $ad->completed_by = auth()->user()->id;
        }
        
        $ad->updated_by = auth()->user()->id;
        $ad->save();
        return redirect(route('needs',$old));
    } 
    public function follow($id)
    {
        $ad = Ad::findorFail($id);
        $ad->comment ="ارسال للمتطوعين بواسطة ".auth()->user()->name;
        $ad->updated_by = auth()->user()->id;
        $ad->assigned_by = auth()->user()->id;
        $ad->status = 3;
        $ad->save();
        return redirect(url()->previous());
    } 

    public function followOld($id)
    {
        $ad = Ad::findorFail($id);
        $ad->comment ="تمت المتابعة";
        $ad->updated_by = auth()->user()->id;
        $ad->save();
        return redirect(route('home'));
    }

    public function edit($id)
    {
        $ad = Ad::findorFail($id);
        $states = State::where('status',1)->get();
        $htypes = Htype::where('status',1)->get();
        return view('edit-ad')->with('ad',$ad)->with('htypes',$htypes)->with('states',$states);
    } 

    public function update(Request $request,$id)
    {
        if($request->result == $request->value1 + $request->value2)
        {
                $ads = Ad::findorFail($id);
                if ($request->hasFile('img')) {
                        //get filename with extension
                        $filenameWithExt = $request->file('img')->getClientOriginalName();
                        //get just filename
                        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        //get just extension
                        $extension = $request->file('img')->getClientOriginalExtension();
                        //create filename to store
                        $fileNametoStore = $filename . '_' . time() . '.' . $extension;
                        //upload image
                        $path = $request->file('img')->move(public_path('img/ads'), $fileNametoStore);
                        //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
                    }
                    if ($request->hasFile('img')) {
                        $ads->img = $fileNametoStore;
                    } 
                    $ads->type = $request->type;
                    $ads->details = $request->details;
                    $ads->area = $request->area;
                    $ads->address = $request->address;
                    $ads->phone = $request->phone;
                    $ads->updated_by = auth()->user()->id;
                    $ads->save();
        
                    return redirect(route('home'));
            
        }

      }
}
