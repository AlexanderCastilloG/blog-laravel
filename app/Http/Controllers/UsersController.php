<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; //import model User
use App\Profile; //import model Profile
use Session; //import Session

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.users.index')->with('users', User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email|unique:users'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt('password')
        ]);

        $profile = Profile::create([
            'user_id'=>$user->id,
            'avatar'=>'uploads/avatars/nouname.jpg'
        ]);

        Session::flash('success', 'User added successfully');

        return redirect()->route('users');


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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);

        if($user->profile->avatar != 'uploads/avatars/nouname.jpg'){
            // Storage::delete($user->profile->avatar);
            unlink($user->profile->avatar);
        }
    
        //eliminar el perfil del usuario
        $user->profile->delete();
        //eliminar el usuario
        $user->delete();

        Session::flash('success', 'User deleted');

        return redirect()->back();
    }

    public function admin($id){
        $user = User::find($id);

        $user->admin = 1;
        $user->save();

        Session::flash('success', 'Successfully changed user permissions.');

        return redirect()->back();
    }

    public function not_admin($id){
        $user = User::find($id);

        $user->admin = 0;
        $user->save();

        return redirect()->back();
    }
}
