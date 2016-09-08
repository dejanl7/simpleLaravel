<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;

class AdminCategoriesController extends Controller
{
    /*===========================
        Index
    =============================*/
    public function index()
    {
        $categories = Category::all();

        return view( 'admin.categories.index', compact('categories') );
    }


    /*===========================
        Create
    =============================*/
    public function create()
    {
 
    }


    /*===========================
        Store
    =============================*/
    public function store(Request $request)
    {
        Category::create( $request->all() );

        return redirect('/admin/categories'); 
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
