@extends("layouts.index")

@section("content")
    <div class="container" id="app">
{{--        <form @submit.prevent="saveData">--}}

        <form action="/customer/create" method="POST">
           @include("customer.form")
        </form>
        @if(session("success"))
            <h3 class="text-primary">{{session("success")}}</h3>
        @endif
    </div>
@endsection


