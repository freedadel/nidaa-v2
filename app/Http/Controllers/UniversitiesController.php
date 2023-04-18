<?php

namespace App\Http\Controllers;

use Session;
use File;

use Illuminate\Http\Request;
use App\University;
use Illuminate\Support\Facades\Session as FacadesSession;

class UniversitiesController extends Controller
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
        $universities = University::all();
        return view('admin.universities.index')->with('universities', $universities);
    }
    public function create()
    {
        return view('admin.universities.create');
    }
    public function store(Request $request)
    {
        $university = new University();
        $this->validate($request, [
            'name' => 'required|string|max:191',
        ]);

        //if logo image send
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
            $path = $request->file('img')->move(public_path('img/universities'), $fileNametoStore);
            //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
        }
        if ($request->hasFile('img')) {
            $university->img = $fileNametoStore;
        } else {
            $university->img = "default.jpg";
        }

        $university->name = $request->name;
        $university->about = $request->about;
        $university->website = $request->website;
        $university->user_id = auth()->user()->id;;
        $university->status = "1";
        $university->save();
        FacadesSession::flash('success', 'University added successfully');

        return redirect(route('Universities.index'));
    }

    public function edit($id)
    {
        $university = University::all()->where("id", $id);
        return view('admin.universities.edit')->with('university', $university);
    }

    public function update(Request $request, $id)
    {
        $university = University::findorFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191',
        ]);

        //if logo image send
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
            $path = $request->file('img')->move(public_path('img/universities'), $fileNametoStore);
            //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
        }
        if ($request->hasFile('img')) {
            $university->img = $fileNametoStore;
        }

        $university->name = $request->name;
        $university->about = $request->about;
        $university->website = $request->website;
        $university->user_id = auth()->user()->id;;
        $university->save();
        FacadesSession::flash('success', 'University Updated successfully');

        return redirect(route('Universities.index'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $university = University::findorFail($id);

        //Delete Image
        if ($university->img != "default.jpg") {
            $image_path = storage_path('app\public\img\universities\\' . $university->img);
            if (File::exists($image_path)) {
                unlink($image_path);
            }
        }

        //then Delete User
        $university->delete();
        FacadesSession::flash('success', 'Deleted Successfully');
        return redirect(route('Universities.index'));
    }

    public function unpublish($id)
    {

        $university = University::find($id);

        $university->status =  '0';

        $university->save();

        FacadesSession::flash('Success', 'Unpublished');

        return redirect(route('Universities.index'));
    }

    public function publish($id)
    {

        $university = University::find($id);

        $university->status =  '1';

        $university->save();

        FacadesSession::flash('Success', 'published');

        return redirect(route('Universities.index'));
    }
}
