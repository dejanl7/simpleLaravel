<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CategoriesCreateRequest;

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
    public function store(CategoriesCreateRequest $request)
    {
        if( empty($request->name) ){
            echo "konj";
        }
        else {
            Category::create( $request->all() );
        }
        

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
        $category = Category::findOrFail($id);

        return view( 'admin.categories.edit', compact('category') );
    }


    /*===========================
        Update
    =============================*/
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update( $request->all() );

        return redirect('/admin/categories');
    }


    /*===========================
        Destroy
    =============================*/
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        return redirect('/admin/categories');
    }
}
