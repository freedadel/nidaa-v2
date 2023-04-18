<?php

namespace App\Http\Controllers;

use App\Category;
use App\Department;
use Session;
use File;

use Illuminate\Http\Request;
use App\University;
use Illuminate\Support\Facades\Session as FacadesSession;

class DepartmentsController extends Controller
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
        $departments = Department::all();
        return view('admin.departments.index')->with('departments', $departments);
    }
    public function create()
    {
        return view('admin.departments.create');
    }
    public function store(Request $request)
    {
        $department = new Department();
        $this->validate($request, [
            'name' => 'required|string|max:191',
        ]);


        $department->name = $request->name;
        $department->user_id = auth()->user()->id;;
        $department->status = "1";
        $department->save();
        FacadesSession::flash('success', 'Department added successfully');

        return redirect(route('Departments.index'));
    }

    public function edit($id)
    {
        $department = Department::all()->where("id", $id);
        return view('admin.departments.edit')->with('department', $department);
    }

    public function update(Request $request, $id)
    {
        $department = Department::findorFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191',
        ]);


        $department->name = $request->name;
        $department->user_id = auth()->user()->id;;
        $department->save();
        FacadesSession::flash('success', 'Department added successfully');

        return redirect(route('Departments.index'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::findorFail($id);

    
        //then Delete User
        $department->delete();
        FacadesSession::flash('success', 'Deleted Successfully');
        return redirect(route('Departments.index'));
    }

    public function unpublish($id)
    {

        $department = Department::find($id);

        $department->status =  '0';

        $department->save();

        FacadesSession::flash('Success', 'Unpublished');

        return redirect(route('Departments.index'));
    }

    public function publish($id)
    {

        $department = Department::find($id);

        $department->status =  '1';

        $department->save();

        FacadesSession::flash('Success', 'published');

        return redirect(route('Departments.index'));
    }
}
