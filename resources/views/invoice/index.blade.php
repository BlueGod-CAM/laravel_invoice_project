@extends("layouts.index")

@section("content")
    <div class="container-fluid">
        <button class="btn btn-success"><a href="/invoice/create" style="color: white" class="text-decoration-none mb-5">Add new Invoice</a></button>

        <hr>
<?php $i=0 ?>
        <table class="table table-responsive">
            <tr>
                <th>No</th>
                <th>Invoice Number</th>
                <th>Invoice At</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Total</th>
                <th>Customer</th>
                <th colspan="3" class="text-center">Action</th>
            </tr>
                @forelse($invoices as $invoice)
                    <tr>
                        <td>{{$i=$i+1}}</td>
                        <td>{{$invoice->invoice_number}}</td>
                        <td>{{$invoice->invoice_at}}</td>
                        <td>{{$invoice->amount}}</td>
                        <td>{{$invoice->currency}}</td>
                        <td>{{$invoice->total}}</td>
                        <td>{{$invoice->user->name ?? "No Data"}}</td>
                        <td><button class="btn btn-primary"><a href="/invoice/show/{{$invoice->id}}" class="text-white text-decoration-none" style="color: white">View</a></button></td>
                        <td><button class="btn btn-warning"><a href="/invoice/edit/{{$invoice->id}}" class="text-white text-decoration-none" style="color: white">Edit</a></button></td>
                        <td><button class="btn btn-danger"><a href="/invoice/delete/{{$invoice->id}}" class="text-white text-decoration-none" style="color: white">Delete</a></button></td>
                    </tr>
                 @empty
                    <td colspan="9">No data available</td>
                @endforelse
        </table>
        {{$invoices->links()}}
    </div>

@endsection
