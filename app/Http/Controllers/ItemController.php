<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Item::with("category")->paginate(15);
        $i=1;
        return view("item.index",compact("items","i"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::where("enabled",1)->latest()->get();
        return view("item.create",compact("categories"));
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
           "name"=>"required",
           "description"=>"required",
           "currency"=>"required",
            "sale_price"=>"required",
            "purchase_price"=>"required",
            "quantity"=>"required",
            "enabled"=>"required"
        ]);

        $item=new Item();
        $item->name=$request->name;
        $item->description=$request->description;
        if($request->currency=="kh"){
            $request->sale_price=$request->sale_price/4100;
            $request->purchase_price=$request->purchase_price/4100;
        }
        $item->sale_price=$request->sale_price;
        $item->purchase_price=$request->purchase_price;
        $item->quantity=$request->quantity;
        $item->category_id=$request->category;
        $item->enabled=$request->enabled;
        $item->save();

        return back()->with("success","The data has been inserted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $items=Item::where("name","=","%".$request->name."%")->get();

        return view("item.index",compact("items"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=Category::where("enabled",1)->latest()->get();
        $item=Item::find($id);
        return view("item.edit",compact("item","categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name"=>"required",
            "description"=>"required",
            "currency"=>"required",
            "sale_price"=>"required",
            "purchase_price"=>"required",
            "quantity"=>"required",
            "enabled"=>"required"
        ]);

        $item=Item::find($id);
        $item->name=$request->name;
        $item->description=$request->description;
        if($request->currency=="kh"){
            $request->sale_price=$request->sale_price/4100;
            $request->purchase_price=$request->purchase_price/4100;
        }
        $item->sale_price=$request->sale_price;
        $item->purchase_price=$request->purchase_price;
        $item->quantity=$request->quantity;
        $item->category_id=$request->category;
        $item->enabled=$request->enabled;
        $item->save();

        return back()->with("success","The data has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::find($id)->delete();

        return back();
    }

    public function updateStatus($status,$id){
        $item=Item::find($id);
        $item->enabled=$status;
        $item->save();
        return back();
    }
}
