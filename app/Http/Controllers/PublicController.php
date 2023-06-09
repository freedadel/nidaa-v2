<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Htype;
use App\Locality;
use App\State;
use App\Volunteer;
use App\Partner;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use SimpleXMLElement;
use App\Transaction;

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
        $ads = Ad::where('status',1)->orderBy('id','DESC')->paginate(50);
        return view('index')->with('ads',$ads)->with('all_ads',$all_ads);
    } 

    public function partners()
    {
        $partners = Partner::where('status',1)->get();
        return view('partners')->with('partners',$partners);
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
        $filter = $request->all();
        $query = Ad::where('status', 1);
        if (isset($filter['word'])) {
            $query->where('details', 'like', '%' . $filter['word'] . '%');
        }
    
        if (isset($filter['htype_id']) && $filter['htype_id'] != "null") {
            $query->where('htype_id', $filter['htype_id']);
        }
    
        if (isset($filter['area']) && $filter['area'] != "null") {
            $query->where('locality_id', $filter['area'] );
        }
    
        if (isset($filter['state_id']) && $filter['state_id'] != "null") {
            $query->where('state_id', $filter['state_id']);
        }
    
        if (isset($filter['type']) && $filter['type'] != "null") {
            $query->where('type', $filter['type']);
        }
    
        $all_ads = $query->orderBy('id', 'DESC')->get();
    
        return view('results')->with('ads', $all_ads)->with('all_ads', $all_ads);
    }

    public function dashboard()
    {
        $ads = Ad::orderBy('id','DESC')->get();
        $states = State::where('status',1)->get();
        $htypes = Htype::where('status',1)->orderBy('order_id','ASC')->get();
        return view('dashboard')->with('ads',$ads)->with('htypes',$htypes)->with('states',$states);
    }

    public function getByState($id)
    {
        $state = State::findorFail($id);
        $all_ads = Ad::where('status',1)->orderBy('id','DESC')->get();
        $ads = Ad::where('status',1)->where('state_id',$id)->orderBy('id','DESC')->paginate(50);
        return view('index')->with('ads',$ads)->with('title',$state->name)->with('all_ads',$all_ads);
    }

    public function getByHtype($id)
    {
        $htype = Htype::findorFail($id);
        $all_ads = Ad::where('status',1)->orderBy('id','DESC')->get();
        $ads = Ad::where('status',1)->where('htype_id',$id)->orderBy('id','DESC')->paginate(50);
        return view('index')->with('ads',$ads)->with('title',$htype->name)->with('all_ads',$all_ads);
    }

    public function getByStatus($id)
    {
        $status = $id==1?"قيد الانتظار":"مكتملة";
        $all_ads = Ad::where('status',1)->orderBy('id','DESC')->get();
        $ads = Ad::where('status',$id)->orderBy('id','DESC')->paginate(50);
        return view('index')->with('ads',$ads)->with('title',$status)->with('all_ads',$all_ads);
    }
    
    public function search()
    {
        $localities = Locality::where('status',1)->get();
        $states = State::where('status',1)->get();
        $htypes = Htype::where('status',1)->orderBy('order_id','ASC')->get();
        return view('search-public')->with('localities',$localities)->with('htypes',$htypes)->with('states',$states);
    }

    public function type1()
    {
        $all_ads = Ad::where('status',1)->orderBy('id','DESC')->get();
        $ads = Ad::where('status',1)->where('type',1)->orderBy('id','DESC')->paginate(50);
        return view('index')->with('ads',$ads)->with('all_ads',$all_ads);
    } 
    public function type2()
    {
        $all_ads = Ad::where('status',1)->orderBy('id','DESC')->get();
        $ads = Ad::where('status',1)->where('type',2)->orderBy('id','DESC')->paginate(50);
        return view('index')->with('ads',$ads)->with('all_ads',$all_ads);
    } 

    public function addNew()
    {
        $htypes = Htype::where('status',1)->orderBy('order_id','ASC')->get();
        $states = State::where('status',1)->get();
        $localities = Locality::where('status',1)->get();
        return view('add-new')->with('htypes',$htypes)->with('states',$states)->with('localities',$localities);
    }
    
    public function addPartners()
    {
        return view('add-partner');
    }

    public function addVolunteer()
    {
        $htypes = Htype::where('status',1)->orderBy('order_id','ASC')->get();
        $states = State::where('status',1)->get();
        $localities = Locality::where('status',1)->get();
        return view('volunteer')->with('htypes',$htypes)->with('states',$states)->with('localities',$localities);
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
                    if(empty(auth()->user()->id))
                    $ads->user_id = 1;
                    else
                    $ads->user_id = auth()->user()->id;
                    $ads->save();

                    $this->eSudani($request->area,$ads->state->name." ".$ads->locality->name,$ads->phone,$ads->details,$ads->htype->name,$ads->type);
        
                    session()->flash('success', 'تمت اضافة الحالة بنجاح');

                    if(empty(auth()->user()->id))
                    {
                        return redirect(route('public.index'));
                    }
                    else
                    {
                        //****** Add Transaction ********** */
                        $trans = new Transaction();
                        $trans->details = "اضافة حالة بواسطة ".auth()->user()->name;
                        $trans->status = 1;
                        $trans->user_id = auth()->user()->id;
                        $trans->save();
                        //********************************* */
                    }
                    return redirect(route('needs',1));
            
        }

    }

    public function eSudani($area,$address,$phone,$details,$category,$type){
        $data = [
                "area" => $area,
                "address" => $address,
                "phone" => $phone,
                "details"=> $details,
                "category"=> $category,
                "type"=> $type,
                 ];

                 //dd($data);
    
        $dataString = json_encode($data);
    
        $headers = [    
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://esudani.com/api/nidaaAddRequest');
    
        curl_setopt($ch, CURLOPT_POST, true);
    
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
    
        $response = curl_exec($ch);
    }

    public function storeVolunteer(Request $request)
    {
        if($request->result == $request->value1 + $request->value2)
        {
                $volunteer = new Volunteer();
                
                $volunteer->name = $request->name;
                $volunteer->place = $request->place;
                $volunteer->country = $request->country;
                $volunteer->area = $request->area;
                $volunteer->address = $request->address;
                $volunteer->phone = $request->phone;
                $volunteer->phone2 = $request->phone2;
                $volunteer->state_id = $request->state;
                $volunteer->locality_id = $request->locality_id;
                $volunteer->htype_id = $request->htype;
                $volunteer->status = 1;
                $volunteer->user_id = 1;
                $volunteer->save();
    
                session()->flash('success', 'شكرا لك، سيتم التواصل معك');

                return redirect(route('public.index'));
            
        }

    }

    public function StorePartners(Request $request)
    {
        if($request->result == $request->value1 + $request->value2)
        {
                $partner = new Partner();
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
                        $path = $request->file('img')->move(public_path('img/partners'), $fileNametoStore);
                        //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
                    }
                    if ($request->hasFile('img')) {
                        $partner->img = $fileNametoStore;
                    } else {
                        $partner->img = "default.jpg";
                    }
                    $partner->name = $request->name;
                    $partner->details = $request->details;
                    $partner->link = $request->link;
                    $partner->phone = $request->phone;
 
                    
                    if(empty(auth()->user()->id))
                    {
                        $partner->user_id = 1;
                        $partner->status = 0;
                    }
                    else
                    {
                        $partner->user_id = auth()->user()->id;
                        $partner->status = 1;

                        //****** Add Transaction ********** */
                        $trans = new Transaction();
                        $trans->details = "اضافة مبادرة بواسطة ".auth()->user()->name;
                        $trans->status = 1;
                        $trans->user_id = auth()->user()->id;
                        $trans->save();
                        //********************************* */
                    }
                    $partner->save();
        
                    session()->flash('success', 'تمت اضافة المبادرة بنجاح، سيتم التحقق والنشر');

                    return redirect(route('public.index'));

            
        }

    }
    
}
