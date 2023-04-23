<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Htype;
use App\Locality;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use SimpleXMLElement;

use function GuzzleHttp\json_decode;

class PublicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_ads = Ad::where('status',1)->orderBy('id','DESC')->get();
        $ads = Ad::where('status',1)->orderBy('id','DESC')->paginate(500);
        return view('index')->with('ads',$ads)->with('all_ads',$all_ads);
    } 

    public function localities(Request $request,$id)
    {
        if ($request->ajax()) {
            return response()->json([
                'localities' => Locality::where('status',1)->where('state_id',$id)->get()
            ]);
        }
    }

    public function searchResultPublic(Request $request)
    {
        if($request->chk == "chk0"){
            if(!empty($request->word))
            $ads = Ad::where('status',1)->where('type',$request->type)->where('details','like','%'.$request->word.'%')->orderBy('id','DESC')->get();
            else
            $ads = [];
        }elseif($request->chk == "chk1"){
            if(!empty($request->htype_id))
            $ads = Ad::where('status',1)->where('type',$request->type)->where('htype_id',$request->htype_id)->orderBy('id','DESC')->get();
            else
            $ads = [];
        }elseif($request->chk == "chk2"){
            if(!empty($request->area))
            $ads = Ad::where('status',1)->where('type',$request->type)->where('area','like','%'.$request->area.'%')->orderBy('id','DESC')->get();
            else
            $ads = [];
        }elseif($request->chk == "chk3"){
            if(!empty($request->state_id))
            $ads = Ad::where('status',1)->where('type',$request->type)->where('state_id',$request->state_id)->orderBy('id','DESC')->get();
            else
            $ads = [];
        }
        $all_ads = Ad::where('status',1)->orderBy('id','DESC')->get();
        return view('results')->with('ads',$ads)->with('all_ads',$all_ads);
    } 

    public function dashboard()
    {
        $ads = Ad::orderBy('id','DESC')->get();
        $states = State::where('status',1)->get();
        $htypes = Htype::where('status',1)->get();
        return view('dashboard')->with('ads',$ads)->with('htypes',$htypes)->with('states',$states);
    }

    public function getByState($id)
    {
        $state = State::findorFail($id);
        $all_ads = Ad::where('status',1)->orderBy('id','DESC')->get();
        $ads = Ad::where('status',1)->where('state_id',$id)->orderBy('id','DESC')->paginate(500);
        return view('index')->with('ads',$ads)->with('title',$state->name)->with('all_ads',$all_ads);
    }

    public function getByHtype($id)
    {
        $htype = Htype::findorFail($id);
        $all_ads = Ad::where('status',1)->orderBy('id','DESC')->get();
        $ads = Ad::where('status',1)->where('htype_id',$id)->orderBy('id','DESC')->paginate(500);
        return view('index')->with('ads',$ads)->with('title',$htype->name)->with('all_ads',$all_ads);
    }

    public function getByStatus($id)
    {
        $status = $id==1?"قيد الانتظار":"مكتملة";
        $all_ads = Ad::where('status',1)->orderBy('id','DESC')->get();
        $ads = Ad::where('status',$id)->orderBy('id','DESC')->paginate(500);
        return view('index')->with('ads',$ads)->with('title',$status)->with('all_ads',$all_ads);
    }
    
    public function search()
    {
        $ads = Ad::distinct()->get(['area']);
        $states = State::where('status',1)->get();
        $htypes = Htype::where('status',1)->get();
        return view('search-public')->with('ads',$ads)->with('htypes',$htypes)->with('states',$states);
    }

    public function type1()
    {
        $all_ads = Ad::where('status',1)->orderBy('id','DESC')->get();
        $ads = Ad::where('status',1)->where('type',1)->orderBy('id','DESC')->paginate(500);
        return view('index')->with('ads',$ads)->with('all_ads',$all_ads);
    } 
    public function type2()
    {
        $all_ads = Ad::where('status',1)->orderBy('id','DESC')->get();
        $ads = Ad::where('status',1)->where('type',2)->orderBy('id','DESC')->paginate(500);
        return view('index')->with('ads',$ads)->with('all_ads',$all_ads);
    } 

    public function addNew()
    {
        $htypes = Htype::where('status',1)->get();
        $states = State::where('status',1)->get();
        $localities = Locality::where('status',1)->get();
        return view('add-new')->with('htypes',$htypes)->with('states',$states)->with('localities',$localities);
    } 
    public function store(Request $request)
    {
        if($request->result == $request->value1 + $request->value2)
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
                    $ads->state_id = $request->state;
                    $ads->locality_id = $request->locality_id;
                    $ads->htype_id = $request->htype;
                    $ads->sec_status = $request->sec_status;
                    $ads->status = 1;
                    $ads->user_id = 1;
                    $ads->save();
        
                    session()->flash('success', 'تمت اضافة العميل بنجاح');

                    return redirect(route('public.index'));
            
        }

      }
 
}
