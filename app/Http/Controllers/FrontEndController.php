<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting; //import modelo setting
use App\Category; //import modelo category
use App\Post; //import modelo post
use App\Tag; //importar modelo Tag

class FrontEndController extends Controller
{
    //
    public function index(){

        //query builder métodos
        return view('index')->with('title', Setting::first()->site_name)
                            // ->with('categories', Category::take(10)->get())
                            ->with('first_post', Post::orderBy('created_at', 'desc')->first())
                            //skip es para omitir 
                            ->with('second_post', Post::orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first())
                            ->with('third_post', Post::orderBy('created_at', 'desc')->skip(2)->take(1)->get()->first())
                            ->with('categories', Category::all())
                            ->with('settings', Setting::first());
    }

    public function singlePost($slug){

        $post = Post::where('slug', $slug)->first();

        if(!$post){
            return 'no hay';
        }

        $next_id = Post::where('id', '>', $post->id)->min('id');
        $prev_id = Post::where('id', '<', $post->id)->max('id');
 

        return view('single')->with('post', $post)
                             ->with('title', Setting::first()->site_name)
                             ->with('categories', Category::take(10)->get())
                             ->with('settings', Setting::first())
                             ->with('next', Post::find($next_id))
                             ->with('prev', Post::find($prev_id))
                             ->with('tags', Tag::all());
    }

    public function category($id){
        $category = Category::find($id);

        return view('category')->with('category', $category)
                               ->with('title', $category->name)
                               ->with('settings', Setting::first())
                               ->with('categories', Category::take(5)->get());
    }

    public function tag($id){

        $tag = Tag::find($id);

        return view('tag')->with('tag', $tag)
                          ->with('title', $tag->tag)
                          ->with('settings', Setting::first())
                          ->with('categories', Category::take(5)->get());
    }
}
