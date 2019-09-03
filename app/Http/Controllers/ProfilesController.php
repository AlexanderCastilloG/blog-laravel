<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; //import la clase autenticación
use Session; //importar la clase sesión
use App\User;//import model user;
use App\Profile;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.users.profile')->with('user', Auth::user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function update(Request $request)
    {

        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email',
            'facebook'=>'required|url',
            'youtube'=>'required|url'
        ]);
        
        $user = Auth::user();

        if($request->hasFile('avatar')){
            $avatar = $request->avatar;

            //obtener el nombre
            $avatar_new_name = time().$avatar->getClientOriginalName();

            if($user->profile->avatar != 'uploads/avatars/nouname.jpg'){
                // Storage::delete($user->profile->avatar);
                unlink($user->profile->avatar);
            }

            //mover al directorio
            $avatar->move('uploads/avatars/', $avatar_new_name);

            // guardar el nombre del avatar en la tabla
            $user->profile->avatar = 'uploads/avatars/'.$avatar_new_name;

            // guardar los cambios
            $user->profile->save();
        }

        if($request->filled('password')){
            $user->password = bcrypt($request->password);
            $user->save();
        }
        
        if($request->filled('about')){
            $user->profile->about = $request->about;
            $user->profile->save();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $user->profile->facebook = $request->facebook;
        $user->profile->youtube = $request->youtube;
        $user->profile->save();

        Session::flash('success', 'Account profile update');

       return redirect()->back();

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
    }
}
