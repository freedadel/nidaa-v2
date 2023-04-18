<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use File;

use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
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
            $path = $request->file('img')->move(public_path('img/Profile'), $fileNametoStore);
            //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
        }
        if ($request->hasFile('img')) {
            $user->img = $fileNametoStore;
        } else {
            $user->img = "profile.jpg";
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_id = auth()->user()->id;
        $user->admin = 0;
        $user->password = Hash::make($request['password']);
        $user->save();
        Session::flash('success', 'You successfully added user');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all()->where("id", $id);
        return view('admin.users.edit')->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findorFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191',
        ]);
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
            $path = $request->file('img')->move(public_path('img/Profile'), $fileNametoStore);
            //$path = $request->file('img')->storeAs('public/img/market/thumbnail/', $fileNametoStore);
        }
        if ($request->hasFile('img')) {
            $user->img = $fileNametoStore;
        }

        if ($request->password) {
            $this->validate($request, [
                'password' => 'required|confirmed|min:6',
            ]);
            $user->password = Hash::make($request['password']);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        Session::flash('Success', 'Updated Successfully');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorFail($id);

        //Delete Profile Image
        if ($user->img != "profile.jpg") {
            $image_path = storage_path('..\public\img\Profile\\' . $user->img);
            if (File::exists($image_path)) {
                unlink($image_path);
            }
        }
        //then Delete User
        $user->delete();
        Session::flash('Success', 'Deleted Successfully');
        return redirect(route('users.index'));
    }

    public function resetPassword($id)
    {
        //dd($id);

        $user = User::find($id);

        $user->password =  Hash::make('password');

        $user->save();

        Session::flash('Success', 'Password reset successfully');

        return redirect(route('users.index'));
    }

    public function makeUser($id)
    {

        $user = User::find($id);

        $user->admin =  '0';

        $user->save();

        Session::flash('Success', 'Admin converted to User');

        return redirect(route('users.index'));
    }

    public function makeAdmin($id)
    {

        $user = User::find($id);

        $user->admin =  '1';

        $user->save();

        Session::flash('Success', 'User converted to Admin');

        return redirect(route('users.index'));
    }
}
