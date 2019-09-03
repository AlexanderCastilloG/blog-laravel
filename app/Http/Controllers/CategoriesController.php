<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category; //import model category
use Session; //import la session

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('admin.categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //ver formulario category
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //almacenar la data
        $this->validate($request, [
            'name'=>'required'
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        //message temporarily
        Session::flash('success', 'You Successfuly created a category');

        return redirect()->route('categories');
        
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

        $category = Category::find($id);

        return view('admin.categories.edit')->with('category', $category);
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

        $this->validate($request , [
            'name'=>'required'
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        //message temporarily
        Session::flash('success', 'You successfult update the category');

        return redirect()->route('categories');

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
        $category = Category::find($id);

        foreach($category->posts as $post){
            //eliminar todos los posts uno por uno
            //eliminación por casacada
            //$post->delete(); //manda el post a la papelera

            //eliminar todo
            $post->forceDelete();

            //  //el método detach eliminará el registro apropiado de la tabla intermedia
            $post->tags()->detach();

        }

        //eliminas la categoria
        $category->delete();

        //message temporarily
        Session::flash('success', 'You successfuly delete the category');

        return redirect()->route('categories');
    }
}
