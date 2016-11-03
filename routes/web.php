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

Route::get('/', function () {
    return view('welcome')
        ->with('posts', \App\Posts::all());
});

Route::get('posts/{id}', [
    'as' => 'posts.show',
    function ($id) {
        $post = \App\Posts::findOrFail($id);

        return view('show')
            ->with('post', $post);
    },
]);

Route::post('posts/{id}/comments', [
    'as' => 'comments.create',
    function ($id, \Illuminate\Http\Request $request) {
        $post = \App\Posts::findOrFail($id);
        $comment = new \App\Comment([
            'comment'  => $request->input('comment'),
            'user_id'  => \Auth::user()->id,
            'posts_id' => $id,
        ]);
        $comment->save();

        broadcast(new \App\Events\NewComment($comment))->toOthers();

        return $comment;
    },
]);

Route::get('posts/{id}/comments', [
    'as' => 'comments.list',
    function ($id) {
        $post = \App\Posts::findOrFail($id);

        return $post->comments;
    },
]);

Auth::routes();

Route::get('/home', 'HomeController@index');
