@extends('layouts.app')

@section('content')
    {{ Form::open(['route' => 'products.store']) }}
        @include('products._form')
    {{ Form::close() }}
@endsection
