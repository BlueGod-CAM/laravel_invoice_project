@extends("layouts.index")

@section("content")
    <div class="container-fluid">
        <button class="btn btn-primary"><a href="/category/create" style="color: white" class="text-white text-decoration-none mb-5">Add new Category</a></button>
<?php $i=0; ?>
        <hr>

        <table class="table table-responsive">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Enabled</th>
                <th colspan="2" class="text-center">Status</th>
                <th colspan="2" class="text-center">Action</th>
            </tr>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$i=$i+1}}</td>
                    <td>{{$category->name}}</td>
                    <td><?php echo substr($category->description,100);  ?></td>
                    @if($category->enabled==1)
                        <td class="text-primary">Enabled</td>
                    @else
                        <td class="text-danger">Forbid</td>
                    @endif
                    <td><a href="/category/update/{{"1"}}/{{$category->id}}">Enable</a></td>
                    <td><a href="/category/update/{{"0"}}/{{$category->id}}">Forbid</a></td>
                    <td><button class="btn btn-warning"><a href="/category/edit/{{$category->id}}" class="text-white text-decoration-none">Edit</a></button></td>
                    <td><button class="btn btn-danger"><a href="/category/delete/{{$category->id}}" class="text-white text-decoration-none">Delete</a></button></td>
                </tr>
                {{--                    @else()--}}
                {{--                        <td colspan="7"><h1 class="text-center">No data available</h1></td>--}}
            @endforeach
            </tbody>
        </table>
        {{$categories->links()}}

    </div>

@endsection
