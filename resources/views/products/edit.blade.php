@extends('layouts.app')

@section('content')
    {{ Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'PUT']) }}
        @include('products._form')
    {{ Form::close() }}
@endsection