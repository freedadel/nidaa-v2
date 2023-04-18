<?php

namespace App\Http\Controllers;

use App\Category;
use App\State;
use Session;
use File;

use Illuminate\Http\Request;
use App\University;
use Illuminate\Support\Facades\Session as FacadesSession;

class StatesController extends Controller
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
        $states = State::all();
        return view('admin.states.index')->with('states', $states);
    }
    public function create()
    {
        return view('admin.states.create');
    }
    public function store(Request $request)
    {
        $state = new State();
        $this->validate($request, [
            'name' => 'required|string|max:191',
        ]);


        $state->name = $request->name;
        $state->user_id = auth()->user()->id;;
        $state->status = "1";
        $state->save();
        FacadesSession::flash('success', 'State added successfully');

        return redirect(route('States.index'));
    }

    public function edit($id)
    {
        $state = State::all()->where("id", $id);
        return view('admin.states.edit')->with('state', $state);
    }

    public function update(Request $request, $id)
    {
        $state = State::findorFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191',
        ]);


        $state->name = $request->name;
        $state->user_id = auth()->user()->id;;
        $state->save();
        FacadesSession::flash('success', 'State added successfully');

        return redirect(route('States.index'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = State::findorFail($id);

    
        //then Delete User
        $state->delete();
        FacadesSession::flash('success', 'Deleted Successfully');
        return redirect(route('States.index'));
    }

    public function unpublish($id)
    {

        $state = State::find($id);

        $state->status =  '0';

        $state->save();

        FacadesSession::flash('Success', 'Unpublished');

        return redirect(route('States.index'));
    }

    public function publish($id)
    {

        $state = State::find($id);

        $state->status =  '1';

        $state->save();

        FacadesSession::flash('Success', 'published');

        return redirect(route('States.index'));
    }
}
