<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostCreateRequest; 

use App\Http\Requests;
use App\Post;
use App\Photo;

class AdminPostsController extends Controller
{
    /*===========================
        Index
    =============================*/
    public function index()
    {
        $posts = Post::all();

        return view( 'admin.posts.index', compact('posts') );
    }


    /*===========================
        Create
    =============================*/
    public function create()
    {
        return view('admin.posts.create');
    }


    /*===========================
        Store
    =============================*/
    public function store(PostCreateRequest $request)
    {
        $input = $request->all();
        $user = Auth::user();

        if( $file = $request->file('photo_id') ){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $user->posts()->create($input);

        return redirect('/admin/posts');
    }


    /*===========================
        Show
    =============================*/
    public function show($id)
    {
        //
    }


    /*===========================
        Edit
    =============================*/
    public function edit($id)
    {
        //
    }


    /*===========================
        Update
    =============================*/
    public function update(Request $request, $id)
    {
        //
    }


    /*===========================
        Destroy
    =============================*/
    public function destroy($id)
    {
        //
    }
}
