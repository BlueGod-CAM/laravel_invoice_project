<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Invoice;
use App\InvoiceItem;
use App\Item;
use Illuminate\Http\Request;
use DB;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices=Invoice::with("user")->paginate(15);

        return view("invoice.index",compact("invoices"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers=Customer::latest()->get();
        $items=Item::where("enabled",1)->latest()->get();

        return view("invoice.create",compact("customers","items"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        DB::beginTransaction();
//        try {
            $request->validate([
                "invoice_number"=>"required",
                "invoice_at"=>"required",
                "currency"=>"required",
                "customer_id"=>"required",
                "products"=>"required"
            ]);
            $invoice=new Invoice();
            $invoice->invoice_number=$request->invoice_number;
            $invoice->invoice_at=$request->invoice_at;
            $invoice->currency=$request->currency;
            $invoice->customer_id=$request->customer_id;
            $invoice->save();
            $amount=0;
            $total=0;
            $currency=$invoice->currency;
            foreach ($request->products as $product){
                $invoice_item=new InvoiceItem();
                $invoice=Invoice::where("invoice_number",$request->invoice_number)->first();
                $invoice_item->invoice_id=$invoice->id;
                $invoice_item->quantity=$product['amount'];
                $invoice_item->item_id=$product['id'];
                $item=Item::find($product['id']);
                $invoice_item->price=$item->sale_price;
                $invoice_item->total=$item->sale_price*$product['amount'];
                $invoice_item->save();
                $id=$invoice->id;
                $amount+=$product["amount"];
                $total+=$invoice_item->total;
            }
            $invoice=Invoice::find($id);
            if($currency=="riel"){
                $total=$total*4100;
            }
            $invoice->amount=$amount;
            $invoice->total=$total;
            $invoice->save();
        return back()->with("success","The data has been inserted");
//        }catch (\Exception $e){
//            report($e);
//            DB::rollback();
//            return back()->with("success","The data cannot insert");
//        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice=Invoice::find($id);
        $invoice_item=InvoiceItem::with('item')->where("invoice_id",$invoice->id)->get();
        $customer=Customer::find($invoice->customer_id);
//        $invoice=Invoice::find($id)->get();
        return view("invoiceitem.profile",compact("invoice","invoice_item","customer"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers=Customer::latest()->get();
        $invoice=Invoice::find($id);
        $items=Item::where("enabled",1)->latest()->get();

        return view("invoice.edit",compact("customers","invoice","items"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "invoice_number"=>"required",
            "invoice_at"=>"required",
            "currency"=>"required",
            "customer_id"=>"required",
            "products"=>"required"
        ]);
        $invoice=Invoice::find($id);
        $invoice->invoice_number=$request->invoice_number;
        $invoice->invoice_at=$request->invoice_at;
        $invoice->currency=$request->currency;
        $invoice->customer_id=$request->customer_id;
        $invoice->save();
        $amount=0;
        $total=0;
        $currency=$invoice->currency;
        InvoiceItem::where("invoice_id",$id)->delete();
        foreach ($request->products as $product){
            $invoice_item=new InvoiceItem();
            $invoice=Invoice::where("invoice_number",$request->invoice_number)->first();
            $invoice_item->invoice_id=$invoice->id;
            $invoice_item->quantity=$product['amount'];
            $invoice_item->item_id=$product['id'];
            $item=Item::find($product['id'])->first();
            $invoice_item->price=$item->sale_price;
            $invoice_item->total=$item->sale_price*$product['amount'];
            $invoice_item->save();
            $amount+=$product["amount"];
            $total+=$invoice_item->total;
        }
        $invoice=Invoice::find($id);
        if($currency=="riel"){
            $total=$total*4100;
        }
        $invoice->amount=$amount;
        $invoice->total=$total;
        $invoice->save();
        return back()->with("success","The data has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Invoice::find($id)->delete();
        return back();
    }
}
