<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest; 
use Illuminate\Session\SessionManager;
use App\User;
use App\Role;
use App\Photo;



class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return View('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::lists('name', 'id')->all();
        
        return View('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {

        $input = $request->all();


        if( $file = $request->file('photo_id') ){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name); 

            $photo = Photo::create( ['file'=>$name] );

            $input['photo_id'] = $photo->id;
        }

        $input['password'] = bcrypt($input['password']);
        User::create($input);
        
        return redirect('/admin/users');


  
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
        $user   = User::findOrFail($id);
        $roles  = Role::lists('name', 'id')->all(); 
        
        return View( 'admin.users.edit',  compact('user', 'roles') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        $user   = User::findOrFail($id);

        if( trim($request->password) == '' ){
            $input = $request->except('password'); // If password is Empty, avoid password editing
        }
            else {
                $input['password'] = bcrypt($request->password);
            }


        if( $file = $request->file('photo_id') ){
            $name = time() . $file->getClientOriginalName();
            
            $file->move( 'images', $name );
            $photo = Photo::create( ['file'=>$name] );
            $input['photo_id'] = $photo->id;
        } 
        $user->update($input);


        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        if( isset($user->photo->file) ){
            unlink( public_path(). $user->photo->file );
        } 
        

        $user->delete();

        $request->session()->flash('deleted_user', 'The user has been deleted');
        return redirect('/admin/users');
    }
}
