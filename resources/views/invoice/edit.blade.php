@extends("layouts.index")

@section("content")
    <div class="container" id="app">
        <form action="/invoice/edit/{{$invoice->id}}" method="POST">
            @include("invoice.form")
        </form>
        @if(session("success"))
            <h3 class="text-primary">{{session("success")}}</h3>
        @endif
    </div>
@endsection
@section("script")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.11/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                count:1,
                item:0,
            },
            methods: {
                AddMore(){
                    console.log("Hello")
                    return this.count++;
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.mdb-select').materialSelect();
        });
    </script>
@endsection
