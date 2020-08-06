@extends("layouts.index")

@section("content")
    <div class="container">
        <form action="/invoice_item/create" method="POST">
            @include("invoiceitem.form")
        </form>
        @if(session("success"))
            <h3 class="text-primary">{{session("success")}}</h3>
        @endif
    </div>
@endsection
