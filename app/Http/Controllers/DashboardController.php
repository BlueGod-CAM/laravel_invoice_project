<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\Invoice;
use App\InvoiceItem;
use App\Item;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $usd=Invoice::where("currency","usd")->sum("total");
        $riel=Invoice::where("currency","riel")->sum("total");
        $total=$usd+($riel/4100);
        $total=round($total);
        $item=Item::latest()->get()->count();
        $customers=Customer::latest()->get()->count();
        $categories=Category::latest()->get()->count();
        $profits=InvoiceItem::with("item")->get()->unique("item_id");
        $items=InvoiceItem::with("item")->get()->unique("item_id");
        $invoices=Invoice::with("user")->orderBy('total', 'DESC')->limit(10)->get()->unique("customer_id");
        return view("dashboard.index",compact("profits","items","customers","categories","item","invoices","usd","riel","total"));
    }
}
