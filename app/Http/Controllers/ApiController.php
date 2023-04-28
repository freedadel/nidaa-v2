<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Locality;
use App\Htype;
use App\State;
use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getStates()
    {
        $states = State::where('status',1)->get();
        return ['total_size'=> count($states),'states'=>$states];
    }

    public function getHtypes()
    {
        $htypes = Htype::where('status',1)->get();
        return ['total_size'=> count($htypes),'htypes'=>$htypes];
    }

    public function getLocalities($id)
    {
        $localities = Locality::where('status',1)->where('state_id',$id)->get();
        return ['total_size'=> count($localities),'localities'=>$localities];
    }

    public function adsStore(Request $request)
    {
        
        $ads = new Ad();
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
            } else {
                $ads->img = "default.jpg";
            }
            $ads->type = $request->type;
            $ads->details = $request->details;
            $ads->area = $request->area;
            $ads->address = $request->address;
            $ads->phone = $request->phone;
            $ads->phone2 = $request->phone2;
            $ads->state_id = $request->state_id;
            $ads->locality_id = $request->locality_id;
            $ads->htype_id = $request->htype_id;
            $ads->sec_status = $request->sec_status;
            $ads->status = 1;
            $ads->user_id = 2;
            $ads->save();

            return ['status'=> 'success','request_id'=>$ads->id];
        }
      
}
