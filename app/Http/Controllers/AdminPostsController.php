<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostCreateRequest; 

use App\Http\Requests;
use App\Post;
use App\Photo;
use App\Category;

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
        $categories = Category::lists('name', 'id')->all();
        return view( 'admin.posts.create', compact('categories') );
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

    }


    /*===========================
        Edit
    =============================*/
    public function edit($id)
    {
        $posts      = Post::findOrFail($id);
        $categories = Category::lists('name', 'id')->all();

        return view( 'admin.posts.edit', compact('posts', 'categories') );
    }


    /*===========================
        Update
    =============================*/
    public function update(Request $request, $id)
    {
        $input = $request->all();

        if( $file = $request->file('photo_id') ){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        Auth::user()->posts()->whereId($id)->first()->update($input);
            
        return redirect('/admin/posts');
    }


    /*===========================
        Destroy
    =============================*/
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        unlink( public_path() . $post->photo->file );
        $post->delete();

        return redirect('/admin/posts');
    }
}
