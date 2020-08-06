<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers=Customer::paginate(15);

        return view("customer.index",compact("customers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("customer.create");
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
           "phone"=>["required","min:8"],
           "email"=>"required",
           "address"=>"required"
        ]);
        $customer= new Customer();
        $customer->name=$request->name;
        $customer->phone=$request->phone;
        $customer->email=$request->email;
        $customer->address=$request->address;

        $customer->save();

        return back()->with("success","The data have been inserted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $customers=Customer::where("name","=","%".$request->name."%")->get();

        return view("customer.index",compact("customers"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer=Customer::find($id);
        return view("customer.edit",compact("customer"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name"=>["required","max:45","min:5"],
            "phone"=>["required","min:8"],
            "email"=>"required",
            "address"=>"required"
        ]);
        $customer=Customer::find($id);
        $customer->name=$request->name;
        $customer->phone=$request->phone;
        $customer->email=$request->email;
        $customer->address=$request->address;

        $customer->save();

        return back()->with("success","The data have been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::find($id)->delete();

        return back();
    }
}
