@extends('wireworks')
@section('content')
    <script>
        var n=1;
        var dirCour='{{$dirCour}}';
        var picmax="{{$topPicQu}}";
    </script>
    <div id='top-banner'>
        <div class='control_left'>
            <div class='control_button_left'><a href='#' id='b_left'> </a></div></div>
        <div class='control_right'>
            <div class='control_button_right'><a href='#' id='b_right'> </a></div></div>
        <img src='/media/img/top/1.jpg' alt='homepage' width=100% class='img-rounded' id='t-ban1'>
    </div><br>

@stop
@section ('scripts')
    @parent
    <script src="{{ asset('/media/js/carousel.js') }}"></script>
    @if(isset($message))
        <script>
            alert('{{$message}}');
        </script>
    @endif
@stop