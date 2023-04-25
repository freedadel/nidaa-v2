<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ad;
use App\State;
use App\Htype;
use App\User;
use Illuminate\Contracts\Session\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends AppBaseController
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(auth()->user()->admin == 1)
        // {
            $ads2 = Ad::where('htype_id',1)->take(10)->orderBy('id','DESC')->get();
            $ads1 = Ad::where('htype_id',2)->take(10)->orderBy('id','DESC')->get();

            $ads1_count = Ad::where('htype_id',1)->orderBy('id','DESC')->count();
            $ads2_count = Ad::where('htype_id',2)->orderBy('id','DESC')->count();
            $states = State::where('status',1)->get();
            $htypes = Htype::where('status',1)->get();
            $users = User::where('status',1)->get();
            return view('home')
            ->with('ads1_count',$ads1_count)
            ->with('ads2_count',$ads2_count)
            ->with('ads1',$ads1)
            ->with('ads2',$ads2)
            ->with('htypes',$htypes)
            ->with('states',$states)
            ->with('users',$users);
        // }
        // elseif(auth()->user()->admin == 2)
        // {
        //     $ads = Ad::orderBy('id','DESC')->get();
        //     $states = State::where('status',1)->get();
        //     $htypes = Htype::where('status',1)->get();
        //     $users = User::where('status',1)->get();
        //     return view('home')->with('ads',$ads)->with('htypes',$htypes)->with('states',$states)->with('users',$users);
        // }
        // elseif(auth()->user()->admin == 3)
        // {
        //     //return redirect(route('needs',3));
        // }
      // return view('home');
    }
    public function report()
    {


        $date = Carbon::now()->subDays(30);

        // First, get the data as an array
        $data = DB::table('ads')
                        ->select(DB::raw('DATE(created_at) as date'), 'htype_id', DB::raw('COUNT(*) as total'))
                        ->where('created_at', '>=', $date)
                        ->groupBy('date', 'htype_id')
                        ->get()
                        ->toArray();
        
        // Next, pivot the data using Laravel's Collection methods
        $pivotedData = collect($data)->groupBy('date')->map(function ($item) {
            return [
                'date' => $item[0]->date,
                'H' => $item->firstWhere('htype_id', 1)->total ?? 0,
                'W' => $item->firstWhere('htype_id',2)->total ?? 0,
            ];
        })->values()->toArray();
    
        // Return JSON response
        return response()->json([
            'data' => $pivotedData,
        ]);
       return view('home');
    }
}
