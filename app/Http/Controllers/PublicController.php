<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Htype;
use App\Faculty;
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
        return view('add-new')->with('htypes',$htypes)->with('states',$states);
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
                    $ads->state_id = $request->state;
                    $ads->htype_id = $request->htype;
                    $ads->sec_status = $request->sec_status;
                    $ads->status = 1;
                    $ads->user_id = 1;
                    $ads->save();
        
                    return redirect(route('public.index'));
            
        }

      }
    function convertPersianNumbersToEnglish($input)
        {
            
                $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '٦', '۶', '۷', '۸', '۹'];
                $english = [ 0 ,  1 ,  2 ,  3 ,  4 ,  4 ,  5 ,  5 ,  6 ,  6 ,  7 ,  8 ,  9 ];
                return str_replace($persian, $english, $input);
            
        }
    public function result(Request $request)
    {
        /*
        $this->validate($request, [
             'percent' => 'numeric|min:50|max:100',
            ],[
             'percent.numeric' => 'الرجاء ادخال نسبة صحيحة ',
            ]
        );
        */
        $current_percent = $this->convertPersianNumbersToEnglish($request->percent);
        //$current_percent = $request->percent;
        //$max_percent = $request->percent + 5;
        $max_percent = $current_percent + 5;
        //$max_percent = 100;

        //$medium_percent_up = $request->percent + 1;
        $medium_percent_up = $current_percent + 1;

        //$medium_percent_down = $request->percent - 3;
        $medium_percent_down = $current_percent - 3;
        
         $this->validate($request, [
            //'g-recaptcha-response' => 'required',
        ]);
        
        if(!empty($request->chk1) && empty($request->chk2) && empty($request->chk3))
        {
            $this->validate($request, [
             'category_id' => 'numeric',
            ],[
             'category_id.numeric' => 'الرجاء اختيار الرغبة',
            ]
        );
                $weak = Faculty::where('category_id',$request->category_id)->
                where('percent','>',$medium_percent_up)->where('percent','<',$max_percent)->
                orderBy('percent', 'DESC')->get();

                $medium = Faculty::where('category_id',$request->category_id)->
                where('percent','>',$medium_percent_down)->where('percent','<=',$medium_percent_up)->
                orderBy('percent', 'DESC')->get();

                $strong = Faculty::where('category_id',$request->category_id)->
                where('percent','<=',$medium_percent_down)->
                orderBy('percent', 'DESC')->get();
        }if(!empty($request->chk2) && empty($request->chk1) && empty($request->chk3))
        {
            $this->validate($request, [
             'department_id' => 'numeric',
            ],[
             'department_id.numeric' => 'الرجاء اختيار المساق',
            ]
        );
                $weak = Faculty::where('dept'.$request->department_id,1)->
                where('percent','>',$medium_percent_up)->where('percent','<',$max_percent)->
                orderBy('percent', 'DESC')->get();

                $medium = Faculty::where('dept'.$request->department_id,1)->
                where('percent','>',$medium_percent_down)->where('percent','<=',$medium_percent_up)->
                orderBy('percent', 'DESC')->get();

                $strong = Faculty::where('dept'.$request->department_id,1)->
                where('percent','<=',$medium_percent_down)->
                orderBy('percent', 'DESC')->get();
        }if(!empty($request->chk3) && empty($request->chk2) && empty($request->chk1))
        {
            $this->validate($request, [
             'state_id' => 'numeric',
                     ],[
             'state_id.numeric' => 'الرجاء اختيار الولاية',
            ]);
                     $weak = Faculty::where('location',$request->state_id)->
                where('percent','>',$medium_percent_up)->where('percent','<',$max_percent)->
                orderBy('percent', 'DESC')->get();

                $medium = Faculty::where('location',$request->state_id)->
                where('percent','>',$medium_percent_down)->where('percent','<=',$medium_percent_up)->
                orderBy('percent', 'DESC')->get();

                $strong = Faculty::where('location',$request->state_id)->
                where('percent','<=',$medium_percent_down)->
                orderBy('percent', 'DESC')->get();
        }
        if(!empty($request->chk1) && !empty($request->chk2) && empty($request->chk3))
        {
            $this->validate($request, [
             'category_id' => 'numeric',
             'department_id' => 'numeric',
                     ],[
             'category_id.numeric' => 'الرجاء اختيار الرغبة',
             'department_id.numeric' => 'الرجاء اختيار المساق',
            ]);
                     $weak = Faculty::where('category_id',$request->category_id)->where('dept'.$request->department_id,1)->
                where('percent','>',$medium_percent_up)->where('percent','<',$max_percent)->
                orderBy('percent', 'DESC')->get();

                $medium = Faculty::where('category_id',$request->category_id)->where('dept'.$request->department_id,1)->
                where('percent','>',$medium_percent_down)->where('percent','<=',$medium_percent_up)->
                orderBy('percent', 'DESC')->get();

                $strong = Faculty::where('category_id',$request->category_id)->where('dept'.$request->department_id,1)->
                where('percent','<=',$medium_percent_down)->
                orderBy('percent', 'DESC')->get();
        }if(!empty($request->chk1) && !empty($request->chk3) && empty($request->chk2))
        {
            $this->validate($request, [
             'category_id' => 'numeric',
             'state_id' => 'numeric',
                     ],[
             'category_id.numeric' => 'الرجاء اختيار الرغبة',
             'state_id.numeric' => 'الرجاء اختيار الولاية',
            ]);
                     $weak = Faculty::where('category_id',$request->category_id)->where('location',$request->state_id)->
                where('percent','>',$medium_percent_up)->where('percent','<',$max_percent)->
                orderBy('percent', 'DESC')->get();

                $medium = Faculty::where('category_id',$request->category_id)->where('location',$request->state_id)->
                where('percent','>',$medium_percent_down)->where('percent','<=',$medium_percent_up)->
                orderBy('percent', 'DESC')->get();

                $strong = Faculty::where('category_id',$request->category_id)->where('location',$request->state_id)->
                where('percent','<=',$medium_percent_down)->
                orderBy('percent', 'DESC')->get();
        }if(!empty($request->chk2) && !empty($request->chk3) && empty($request->chk1))
        {
            $this->validate($request, [
             'state_id' => 'numeric',
             'department_id' => 'numeric',
                     ],[
             'department_id.numeric' => 'الرجاء اختيار المساق',
             'state_id.numeric' => 'الرجاء اختيار الولاية',
            ]);
                     $weak = Faculty::where('dept'.$request->department_id,1)->where('location',$request->state_id)->
                where('percent','>',$medium_percent_up)->where('percent','<',$max_percent)->
                orderBy('percent', 'DESC')->get();

                $medium = Faculty::where('dept'.$request->department_id,1)->where('location',$request->state_id)->
                where('percent','>',$medium_percent_down)->where('percent','<=',$medium_percent_up)->
                orderBy('percent', 'DESC')->get();

                $strong = Faculty::where('dept'.$request->department_id,1)->where('location',$request->state_id)->
                where('percent','<=',$medium_percent_down)->
                orderBy('percent', 'DESC')->get();
        }if(!empty($request->chk1) && !empty($request->chk2) && !empty($request->chk3))
        {
            $this->validate($request, [
             'state_id' => 'numeric',
             'department_id' => 'numeric',
             'category_id' => 'numeric',
                     ],[
             'department_id.numeric' => 'الرجاء اختيار المساق',
             'state_id.numeric' => 'الرجاء اختيار الولاية',
             'category_id.numeric' => 'الرجاء اختيار الرغبة',
            ]);
                     $weak = Faculty::where('category_id',$request->category_id)->where('dept'.$request->department_id,1)->where('location',$request->state_id)->
                where('percent','>',$medium_percent_up)->where('percent','<',$max_percent)->
                orderBy('percent', 'DESC')->get();

                $medium = Faculty::where('category_id',$request->category_id)->where('dept'.$request->department_id,1)->where('location',$request->state_id)->
                where('percent','>',$medium_percent_down)->where('percent','<=',$medium_percent_up)->
                orderBy('percent', 'DESC')->get();

                $strong = Faculty::where('category_id',$request->category_id)->where('dept'.$request->department_id,1)->where('location',$request->state_id)->
                where('percent','<=',$medium_percent_down)->
                orderBy('percent', 'DESC')->get();
        }
        
        


        return view('results')->with('weak',$weak)->with('medium',$medium)->with('strong',$strong);
    } 
    
}
