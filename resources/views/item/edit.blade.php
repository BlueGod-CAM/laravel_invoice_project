@extends("layouts.index")

@section("content")
    <div class="container">
        <form action="/item/edit/{{$item->id}}" method="POST">
            @include("item.form")
        </form>
        @if(session("success"))
            <h3 class="text-primary">{{session("success")}}</h3>
        @endif
    </div>
@endsection
@section("script")
    <script src="https://cdn.ckeditor.com/ckeditor5/21.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
