@extends("layouts.index")

@section("content")
    <div class="container-fluid">
        <button class="btn btn-primary"><a href="/item/create" style="color: white" class="text-white text-decoration-none mb-5">Add new Item</a></button>
        <hr>

        <table class="table table-responsive">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Sale Price</th>
                <th>Purchase Price</th>
                <th>Quantity</th>
                <th>Category</th>
                <th>Enable</th>
                <th colspan="2" class="text-center">Status</th>
                <th colspan="2" class="text-center">Action</th>
            </tr>
            <tbody>

            @foreach($items as $item)
                <tr>

                    <td>{{$i++}}</td>
                    <td>{{$item->name}}</td>
                    <td><?php echo $item->description ?></td>
                    <td>{{$item->sale_price}}</td>
                    <td>{{$item->purchase_price}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->category->name}}</td>
                    <td>
                        @if($item->enabled=="1")
                           <span class="text-primary"> Enabled </span>
                        @else
                            <span class="text-danger">Forbid</span>
                        @endif
                    </td>
                    <td><button class="btn btn-warning"><a href="/item/edit/{{$item->id}}" class="text-white text-decoration-none">Edit</a></button></td>
                    <td><button class="btn btn-danger"><a href="/item/delete/{{$item->id}}" class="text-white text-decoration-none">Delete</a></button></td>
                    <td><a href="/item/update/{{"1"}}/{{$item->id}}">Enable</a></td>
                    <td><a href="/item/update/{{"0"}}/{{$item->id}}">Forbid</a></td>
                </tr>
                {{--                    @else()--}}
                {{--                        <td colspan="7"><h1 class="text-center">No data available</h1></td>--}}
            @endforeach
            </tbody>
        </table>
        {{$items->links()}}
    </div>

@endsection
