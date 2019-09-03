<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/test', function(){
    //One to many
    // return App\Category::find(3)->posts;
    // dd(App\category::find(3)->posts());
    //método findorfail();
    // return App\Post::find(4)->category;

    //many to many
    // return App\Tag::find(6)->posts;
    // return App\Tag::find(6)->posts;
    // return App\Post::find(6)->tags;

    //One to One
    // return App\User::findorfail(1)->profile;
    return App\Profile::findOrFail(1)->user;
}); 

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', ['uses'=>'FrontEndController@index', 'as'=>'index']);
//ver cada post
Route::get('/post/{slug}', ['uses'=>'FrontEndController@singlePost', 'as'=>'post.single']);
//ver cada categoria
Route::get('/category/{id}', ['uses'=>'FrontEndController@category', 'as'=>'category.single']);
//ver cada etiqueta
Route::get('/tag/{id}', ['uses'=>'FrontEndController@tag', 'as'=>'tag.single']);
//ver la busqueda de cada post
Route::get('/results', function(){

    //la variable a recibir se llama q
    $posts = \App\Post::where('title','like', '%'. request('q').'%')->get();

    return view('results')->with('posts', $posts)
                          ->with('title', 'Resultados búsqueda para :' .request('q'))
                          ->with('settings', \App\Setting::first())
                          ->with('categories', \App\Category::take(5)->get());


});
//guardar los suscriptores
Route::post('/subscribe', function(){

    $email = request('email');
    Newsletter::subscribe($email);

    Session::flash('subscribed', 'Suscrito exitosamente');

    return redirect()->back();
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

//Route group and middleware
Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function(){

    //Home
    Route::get('/dashboard', ['uses'=>'HomeController@index', 'as'=>'home']);


    //index post
    Route::get('/posts',['uses'=>'PostsController@index', 'as'=>'posts']);
    
    //ver el formulario post
    Route::get('/post/create', ['uses'=>'PostsController@create', 'as'=>'post.create']);

    //guardar data al formulario
    Route::post('/post/store', ['uses'=>'PostsController@store', 'as'=>'post.store']);

    //Enviar un post a la papelera
    Route::get('/post/delete/{id}',['uses'=>'PostsController@destroy', 'as'=>'post.delete']);

    //Editar un post
    Route::get('/post/edit/{id}', ['uses'=>'PostsController@edit', 'as'=>'post.edit']);

    //Actualizar un post
    Route::post('/post/update/{id}', ['uses'=>'PostsController@update', 'as'=>'post.update']);

    //ver Papelera de posts
    Route::get('/posts/trashed', ['uses'=>'PostsController@trashed', 'as'=>'posts.trashed']);

    //eliminar un post de la papelera por completo
    Route::get('/posts/kill/{id}', ['uses'=>'PostsController@kill', 'as'=>'post.kill']);

    //restaurar un post desde la papelera 
    Route::get('/posts/restore/{id}', ['uses'=>'PostsController@restore', 'as'=>'post.restore']);



    //ver todos los datos categorias
    Route::get('/categories', ['uses'=>'CategoriesController@index', 'as'=>'categories']);

    //ver el formulario de categorias
    Route::get('/category/create', ['uses'=>'CategoriesController@create', 'as'=>'category.create']);

    //guardar data al formulario categorias
    Route::post('/category/store', ['uses'=>'CategoriesController@store', 'as'=>'category.store']);

    //ver datos en el formulario para editar categorias
    Route::get('/category/edit/{id}', ['uses'=>'CategoriesController@edit', 'as'=>'category.edit']);
    //Actualizat los datos de una categoria
    Route::post('/category/update/{id}', ['uses'=>'CategoriesController@update', 'as'=>'category.update']);

    //borrar una categoria
    Route::get('/category/delete/{id}', ['uses'=>'CategoriesController@destroy', 'as'=>'category.delete']);


    //index tags
    Route::get('/tags', ['uses'=>'TagsController@index', 'as'=>'tags']);
    //create tag
    Route::get('/tag/create', ['uses'=>'TagsController@create', 'as'=>'tag.create']);
    //store tag
    Route::post('/tag/store', ['uses'=>'TagsController@store', 'as'=>'tag.store']);
    //edit tag
    Route::get('/tag/edit/{id}', ['uses'=>'TagsController@edit', 'as'=>'tag.edit']);
    //delete tag
    Route::get('/tag/delete/{id}', ['uses'=>'TagsController@destroy', 'as'=>'tag.delete']);
    //actualizar el tag
    Route::post('/tag/update/{id}', ['uses'=>'TagsController@update', 'as'=>'tag.update']);


    //index users
    Route::get('/users', ['uses'=>'UsersController@index', 'as'=>'users']);
    //create a user
    Route::get('/user/create', ['uses'=>'UsersController@create', 'as'=>'user.create']);
    //store a user
    Route::post('/user/store', ['uses'=>'UsersController@store', 'as'=>'user.store']);
    //volver un usuario a un administrador
    Route::get('/user/admin/{id}', ['uses'=>'UsersController@admin', 'as'=>'user.admin']);
    //quitarle permiso a un administrador
    Route::get('/user/not-admin/{id}', ['uses'=>'UsersController@not_admin', 'as'=>'user.not.admin']);
    //eliminar un usuario 
    Route::get('/user/delete/{id}', ['uses'=>'UsersController@destroy', 'as'=>'user.delete']);

    //ver el perfil de un usuario
    Route::get('/user/profile', ['uses'=>'ProfilesController@index', 'as'=>'user.profile']);
    //actualizar el perfil de un usuario
    Route::post('/user/profile/update', ['uses'=>'ProfilesController@update', 'as'=>'user.profile.update']);

    //ver ajustes
    Route::get('/settings',['uses'=>'SettingsController@index', 'as'=>'settings']);
    //actualizar el ajuste
    Route::post('/settings/update',['uses'=>'SettingsController@update', 'as'=>'settings.update']);
});