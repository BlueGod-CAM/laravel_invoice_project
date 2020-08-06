@extends("layouts.index")

@section("content")
    <div class="container-fluid">
        <hr>

        <table class="table table-responsive">
            <tr>
                <th>No</th>
                <th>Invoice Number</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            <?php
                $i=0;
            ?>
                @forelse($invoices as $invoice)
                    <tr>
                        <td>{{$i=$i+1}}</td>
                        <td>{{$invoice->invoice_id}}</td>
                        <td>{{$invoice->item->name}}</td>
                        <td>{{$invoice->quantity}}</td>
                        <td>{{$invoice->price}}</td>
                        <td>{{$invoice->total}}</td>
                    </tr>
                @empty
                    <td colspan="8">No data available</td>
                @endforelse
        </table>
        {{$invoices->links()}}
    </div>

@endsection
