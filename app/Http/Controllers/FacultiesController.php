<?php

namespace App\Http\Controllers;

use App\Category;
use App\Department;
use App\Faculty;
use App\State;
use Session;
use File;

use Illuminate\Http\Request;
use App\University;
use Illuminate\Support\Facades\Session as FacadesSession;

class FacultiesController extends Controller
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
        if(empty(session('university_id')))
        $faculties = Faculty::orderBy('updated_at','ASC')->get();
        else
        $faculties = Faculty::where('university_id',session('university_id'))->orderBy('updated_at','ASC')->get();

        $universities = University::where('status',1)->get();
        return view('admin.faculties.index')->with('faculties', $faculties)->with('universities', $universities);
    }
    public function create()
    {
        $universities = University::where('status',1)->get();
        $categories = Category::all();
        $departments = Department::all();
        $states = State::all();
        return view('admin.faculties.create')->with('universities',$universities)
        ->with('categories',$categories)->with('departments',$departments)
        ->with('states', $states);;
    }
    public function store(Request $request)
    {
        $faculty = new Faculty();
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'university_id' => 'required|integer',
            'category_id' => 'required|integer',
            'percent' => 'required|numeric',
            'location' => 'required|string|max:191',
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
            $faculty->img = $fileNametoStore;
        } else {
            $faculty->img = "default.jpg";
        }
        if(isset($request->chk1)){
            $faculty->dept1 = 1;
        }if(isset($request->chk2)){
            $faculty->dept2 = 1;
        }if(isset($request->chk3)){
            $faculty->dept3 = 1;
        }if(isset($request->chk4)){
            $faculty->dept4 = 1;
        }if(isset($request->chk5)){
            $faculty->dept5 = 1;
        }if(isset($request->chk6)){
            $faculty->dept6 = 1;
        }if(isset($request->chk7)){
            $faculty->dept7 = 1;
        }if(isset($request->chk8)){
            $faculty->dept8 = 1;
        }if(isset($request->chk9)){
            $faculty->dept9 = 1;
        }
        $faculty->name = $request->name;
        $faculty->university_id = $request->university_id;
        $faculty->category_id = $request->category_id;
        $faculty->department_id = $request->department_id;
        $faculty->percent = $request->percent;
        $faculty->location = $request->location;
        $faculty->website = $request->website;
        $faculty->about = $request->about;
        $faculty->user_id = auth()->user()->id;;
        $faculty->status = "1";
        $faculty->save();
        FacadesSession::flash('success', 'Faculty added successfully');

        return redirect(route('Faculties.index'));
    }

    public function edit($id)
    {
        $states = State::all();
        $universities = University::where('status',1)->get();
        $categories = Category::all();
        $departments = Department::all();
        $faculty = Faculty::all()->where("id", $id);
        return view('admin.faculties.edit')->with('faculty',$faculty)
        ->with('categories',$categories)->with('universities', $universities)
        ->with('departments',$departments)->with('states', $states);
    }
    public function percent(Request $request, $id)
    {
        $faculty = Faculty::findorFail($id);
        $faculty->percent = $request->percent;
        $faculty->save();

        return redirect(route('Faculties.index'));
    }

    public function facultyUpdate($id,Request $request)
    {
        $faculty = Faculty::findorFail($id);
        $faculty->percent = $request->percent;
        $faculty->save();

        return redirect(route('Faculties.index'));
    }

    public function getByUniversity(Request $request)
    {
        session()->put('university_id',$request->university_id);

        return redirect(route('Faculties.index'));
    }

    public function update(Request $request, $id)
    {
        $faculty = Faculty::findorFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'university_id' => 'required|integer',
            'category_id' => 'required|integer',
            'percent' => 'required|numeric',
            'location' => 'required|string|max:191',
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
            $faculty->img = $fileNametoStore;
        }
        if(isset($request->chk1)){
            $faculty->dept1 = 1;
        }else{
            $faculty->dept1 = 0;
        }
        if(isset($request->chk2)){
            $faculty->dept2 = 1;
        }else{
            $faculty->dept2 = 0;
        }if(isset($request->chk3)){
            $faculty->dept3 = 1;
        }else{
            $faculty->dept3 = 0;
        }if(isset($request->chk4)){
            $faculty->dept4 = 1;
        }else{
            $faculty->dept4 = 0;
        }if(isset($request->chk5)){
            $faculty->dept5 = 1;
        }else{
            $faculty->dept5 = 0;
        }if(isset($request->chk6)){
            $faculty->dept6 = 1;
        }else{
            $faculty->dept6 = 0;
        }if(isset($request->chk7)){
            $faculty->dept7 = 1;
        }else{
            $faculty->dept7 = 0;
        }if(isset($request->chk8)){
            $faculty->dept8 = 1;
        }else{
            $faculty->dept8 = 0;
        }if(isset($request->chk9)){
            $faculty->dept9 = 1;
        }else{
            $faculty->dept9 = 0;
        }
        $faculty->name = $request->name;
        $faculty->university_id = $request->university_id;
        $faculty->category_id = $request->category_id;
        $faculty->department_id = $request->department_id;
        $faculty->percent = $request->percent;
        $faculty->location = $request->location;
        $faculty->website = $request->website;
        $faculty->about = $request->about;
        $faculty->user_id = auth()->user()->id;;
        $faculty->save();
        FacadesSession::flash('success', 'Faculty Updated successfully');

        return redirect(route('Faculties.index'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faculty = Faculty::findorFail($id);

        //Delete Image
        if ($faculty->img != "default.jpg") {
            $image_path = storage_path('app\public\img\faculties\\' . $faculty->img);
            if (File::exists($image_path)) {
                unlink($image_path);
            }
        }

        //then Delete User
        $faculty->delete();
        FacadesSession::flash('success', 'Deleted Successfully');
        return redirect(route('Faculties.index'));
    }

    public function unpublish($id)
    {

        $faculty = Faculty::find($id);

        $faculty->status =  '0';

        $faculty->save();

        FacadesSession::flash('Success', 'Unpublished');

        return redirect(route('Faculties.index'));
    }

    public function publish($id)
    {

        $faculty = Faculty::find($id);

        $faculty->status =  '1';

        $faculty->save();

        FacadesSession::flash('Success', 'published');

        return redirect(route('Faculties.index'));
    }
}
