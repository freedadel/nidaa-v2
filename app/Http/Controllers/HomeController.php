<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ad;

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
        return view('index-admin')->with('ads',$ads);
    } 
    public function done($id)
    {
        $ad = Ad::findorFail($id);
        $ad->status = 2;
        $ad->save();
        return redirect(route('home'));
    } 

    public function edit($id)
    {
        $ad = Ad::findorFail($id);
        return view('edit-ad')->with('ad',$ad);
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
                    $ads->save();
        
                    return redirect(route('home'));
            
        }

      }
}
