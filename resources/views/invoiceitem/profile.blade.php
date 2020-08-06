@extends("layouts.index")

@section("content")
    <div>
        <div class="card">
            <div class="card-header p-4">
                <div class="float-right">
                    <h3 class="mb-0">Invoice #{{$invoice->invoice_number}}</h3>
                    Date: {{$invoice->invoice_at}}
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h2 class="mb-3">Customer:</h2>
                        <h1 class="text-dark" style="margin-bottom: 20px">{{$customer->name}}</h1>
                        <div>{{$customer->address}}</div>
                        <div>Email: {{$customer->email}}</div>
                        <div>Phone: {{$customer->phone}}</div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="center">#</th>
                            <th>Item</th>
                            <th>Description</th>
                            <th class="right">Price</th>
                            <th class="center">Qty</th>
                            <th class="right">Total</th>
                        </tr>
                        </thead>
                        <?php  $i=0; ?>
                        <tbody>
                            @foreach($invoice_item as $item)
                                <tr>
                                    <td>{{$i=$i+1}}</td>
                                    <td>{{$item->item->name}}</td>
                                    <td><?php echo $item->item->description;?></td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->total}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                            <tr>
                                <td class="left">
                                    <strong class="text-dark">Currency</strong>
                                </td>
                                <td class="right">{{$invoice->currency}}</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong class="text-dark">Amount</strong>
                                </td>
                                <td class="right">{{$invoice->amount}}</td>
                            </tr>
                            @if($invoice->currency=='riel')
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Total(USD)</strong> </td>
                                    <td class="right">
                                        <strong class="text-dark">{{$invoice->total / 4100 }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Total(Riel)</strong> </td>
                                    <td class="right">
                                        <strong class="text-dark">{{$invoice->total}}</strong>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Total(USD)</strong> </td>
                                    <td class="right">
                                        <strong class="text-dark">{{$invoice->total}}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Total(Riel)</strong> </td>
                                    <td class="right">
                                        <strong class="text-dark">{{$invoice->total * 4100}}</strong>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <p class="mb-0">Codingate, Phnom Penh, Cambodia</p>
            </div>
        </div>
    </div>
@endsection
