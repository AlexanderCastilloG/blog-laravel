<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category; //import model category
use App\Post; //import model Post
use App\Tag; //import model Tag
use Session; //import session
use Auth; // importar la autenticación

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //chunk
        // $posts = Post::orderBy('created_at', 'desc')->get()->chunk(5);

        //
        // return view('admin.posts.index')->with('posts', Post::all());
        return view('admin.posts.index')->with('posts', Post::orderBy('created_at', 'desc')->paginate(3));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $tags = Tag::all();

        if($categories->count() == 0 || $tags->count() ==0){
            
            Session::flash('info', 'You must have some categories and tags before attempting to create a post');

            return redirect()->back();
        }

        return view('admin.posts.create')->with('categories', $categories)
                                        ->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //store data
        $this->validate($request , [
            'title'=>'required',
            'featured'=>'required|image',
            'content'=>'required',
            'category_id'=>'required',
            'tags'=>'required'
        ]);

        //name temporaly 
        $featured = $request->featured;

        //name original + concatenado el time
        $featured_new_name = time(). $featured->getClientOriginalName();

        //mover la image a al directorio uploads/posts
        $featured->move('uploads/posts', $featured_new_name);
        
        $post = Post::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'category_id'=>$request->category_id,
            'featured'=>'uploads/posts/'.$featured_new_name,
            'slug'=>str_slug($request->title),
            'user_id'=>Auth::id()
        ]);

        //relación de muchos a muchos 
        //con el método attach
        $post->tags()->attach($request->tags);

        Session::flash('success', 'Posts created successfuly');

        // return redirect()->back();
        return redirect()->route('posts');
        
        
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
        $post = Post::find($id);

        return view('admin.posts.edit')->with('post', $post)
                                        ->with('categories', Category::all())
                                        ->with('tags', Tag::all());
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
        $this->validate($request, [
            'title'=>'required',
            'content'=>'required',
            'category_id'=>'required',
            'featured'=>'image',
            'tags'=>'required'
        ]);

        $post = Post::find($id);

        //solo si envias una imagen
        if($request->hasFile('featured')){
            $featured = $request->featured;

            //crear un nuevo nombre a la imagen actualizada
            $featured_new_name = time().$featured->getClientOriginalName();

            //mover la imagen al directorio
            $featured->move('uploads/posts', $featured_new_name);

            //actualizar la imagen
            $post->featured = 'uploads/posts/'.$featured_new_name;
        }

        //actualizar los datos
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->slug = str_slug($request->title);
        $post->save();

        //método de sincronización para construir asociaciones de muchos a muchos
        $post->tags()->sync($request->tags);

        Session::flash('success', 'Post Updated successfully');

        return redirect()->route('posts');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete function posts
        $post = Post::find($id);
        $post->delete();

        Session::flash('success', 'The post was just trashed');
        return redirect()->back();
    }

    public function trashed(){
        //el método onlyTrashed solo recuperará los modelos borrados
        $posts = Post::onlyTrashed()->get();

        return view('admin.posts.trashed')->with('posts', $posts);
    }

    public function kill($id){
        //first es para obtener una instancia del post posterior
        $post = Post::withTrashed()->where('id', $id)->get()->first();

        //el método forceDelete para eliminar los datos permanentemente
        $post->forceDelete();

        //el método detach eliminará el registro apropiado de la tabla intermedia
        $post->tags()->detach();
        
        Session::flash('success', 'Post Deleted permanently');

        return redirect()->back();
    }

    public function restore($id){
        $post = Post::withTrashed()->where('id',$id)->get()->first();

        $post->restore();

        Session::flash('success', 'Post restored successfully');

        return redirect()->route('posts');
    }    
}
