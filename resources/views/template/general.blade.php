@extends('wireworks')
@section('content')
    <h1>{{$content->name}}</h1>

        {!! $content->body !!}

@stop
