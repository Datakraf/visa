@extends('backend.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('travel.name') !!}
    </p>
@stop