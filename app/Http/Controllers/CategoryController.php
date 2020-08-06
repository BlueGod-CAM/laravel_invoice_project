<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::paginate(15);

        return view("category.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>["required","max:45","min:5"],
            "description"=>"required",
            "enabled"=>"required"
        ]);
        $categories=new Category();
        $categories->name=$request->name;
        $categories->description=$request->description;
        $categories->enabled=$request->enabled;
        $categories->save();

        return back()->with("success","The date have been inserted");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $categories=Category::where("name","=","%".$request->name."%")->get();

        return view("category.index",compact("categories"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::find($id);
        return view("category.edit",compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name"=>["required","max:45","min:5"],
            "description"=>"required",
            "enabled"=>"required"
        ]);
        $categories=Category::find($id);
        $categories->name=$request->name;
        $categories->description=$request->description;
        $categories->enabled=$request->enabled;
        $categories->save();

        return back()->with("success","The date have been updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();

        return back();
    }

    public function updateStatus($status,$id){
        $category=Category::find($id);
        $category->enabled=$status;
        $category->save();

        return back();
    }
}
