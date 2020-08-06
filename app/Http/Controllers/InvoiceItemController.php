<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoiceItem;
use App\Item;
use Illuminate\Http\Request;
use DB;

class InvoiceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices=InvoiceItem::with("item")->paginate(15);

        return view("invoiceitem.index",compact("invoices"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items=Item::latest()->get();
        return view("invoiceitem.create",compact("items"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                "invoice_number"=>"required",
                "item_id"=>"required",
                "quantity"=>"required"
            ]);

            $invoice_item=new InvoiceItem();
            $invoice=Invoice::where("invoice_number",$request->invoice_number)->first();
            if(!$invoice){
                return back()->with("success","This invoice number does not exits");
            }
            $invoice_item->invoice_id=$invoice->id;
            $invoice_item->item_id=$request->item_id;
            $invoice_item->quantity=$request->quantity;
            $item=Item::find($request->item_id)->first();
            $invoice_item->price=$item->sale_price;
            $invoice_item->total=($invoice_item->price)*($invoice_item->quantity);
            $invoice_item->save();
            $amount=InvoiceItem::where("invoice_id",$invoice_item->invoice_id)->count();
            $invoice=Invoice::find($invoice_item->invoice_id);
            $invoice->amount=$amount;
            $total=InvoiceItem::where("invoice_id",$invoice_item->invoice_id)->sum("total");
            $invoice->total=$total;
            $invoice->save();
            DB::commit();
            return back()->with("success","The data has been inserted");
        }catch (\Exception $e){
            report($e);
            DB::rollback();
            return back()->with("success","The data cannot insert");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InvoiceItem  $invoiceItem
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $invoices=InvoiceItem::where("invoice_number","=","%".$request->number."%")->get();

        return view("invoiceitem.index",compact("invoices"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvoiceItem  $invoiceItem
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items=Item::latest()->get();
        $invoiceItem=InvoiceItem::find($id);
        return view("invoiceitem.edit",compact("items","invoiceItem"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvoiceItem  $invoiceItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                "invoice_number"=>"required",
                "item_id"=>"required",
                "quantity"=>"required"
            ]);

            $invoice_item=InvoiceItem::find($id);
            $invoice=Invoice::where("invoice_number",$request->invoice_number)->first();
            if(!$invoice){
                return back()->with("success","This invoice number does not exits");
            }
            $invoice_item->invoice_id=$invoice->id;
            $invoice_item->item_id=$request->item_id;
            $invoice_item->quantity=$request->quantity;
            $item=Item::find($request->item_id)->first();
            $invoice_item->price=$item->sale_price;
            $invoice_item->total=($invoice_item->price)*($invoice_item->quantity);
            $invoice_item->save();
            $amount=InvoiceItem::where("invoice_id",$invoice_item->invoice_id)->count();
            $invoice=Invoice::find($invoice_item->invoice_id);
            $invoice->amount=$amount;
            $total=InvoiceItem::where("invoice_id",$invoice_item->invoice_id)->sum("total");
            if($invoice->currency=="riel"){
                $total=$total*4100;
            }
            $invoice->total=$total;
            $invoice->save();
            DB::commit();
            return back()->with("success","The data has been updated");
        }catch (\Exception $e){
            report($e);
            DB::rollback();
            return back()->with("success","The data cannot insert");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvoiceItem  $invoiceItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InvoiceItem::find($id)->delete();

        return back();
    }
}
