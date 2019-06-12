{{ Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete', 'class' => 'd-none'])}}
{{Form::close()}}