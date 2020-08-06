@extends("layouts.index")

@section("content")
    <div class="container">
        <form action="/customer/edit/{{$customer->id}}" method="POST">
            @include("customer.form")
        </form>
        @if(session("success"))
            <h3 class="text-primary">{{session("success")}}</h3>
        @endif
    </div>
@endsection
