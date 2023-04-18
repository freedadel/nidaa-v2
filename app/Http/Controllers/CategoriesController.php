<?php

namespace App\Http\Controllers;

use App\Category;
use Session;
use File;

use Illuminate\Http\Request;
use App\University;
use Illuminate\Support\Facades\Session as FacadesSession;

class CategoriesController extends Controller
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
        $categories = Category::all();
        return view('admin.categories.index')->with('categories', $categories);
    }
    public function create()
    {
        return view('admin.categories.create');
    }
    public function store(Request $request)
    {
        $category = new Category();
        $this->validate($request, [
            'name' => 'required|string|max:191',
        ]);


        $category->name = $request->name;
        $category->user_id = auth()->user()->id;;
        $category->status = "1";
        $category->save();
        FacadesSession::flash('success', 'Category added successfully');

        return redirect(route('Categories.index'));
    }

    public function edit($id)
    {
        $category = Category::all()->where("id", $id);
        return view('admin.categories.edit')->with('category', $category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findorFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191',
        ]);


        $category->name = $request->name;
        $category->user_id = auth()->user()->id;;
        $category->save();
        FacadesSession::flash('success', 'Category added successfully');

        return redirect(route('Categories.index'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findorFail($id);

    
        //then Delete User
        $category->delete();
        FacadesSession::flash('success', 'Deleted Successfully');
        return redirect(route('Categories.index'));
    }

    public function unpublish($id)
    {

        $category = Category::find($id);

        $category->status =  '0';

        $category->save();

        FacadesSession::flash('Success', 'Unpublished');

        return redirect(route('Categories.index'));
    }

    public function publish($id)
    {

        $category = Category::find($id);

        $category->status =  '1';

        $category->save();

        FacadesSession::flash('Success', 'published');

        return redirect(route('Categories.index'));
    }
}
