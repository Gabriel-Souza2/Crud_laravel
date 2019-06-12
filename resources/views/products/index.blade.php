@extends('layouts.app')

@section('content')
<div>
    <div class="row">
        <div class="col-md-12 text-center">
            <a href="{{ route('products.create') }}" class="btn btn-success float-right">Criar</a>
            <h1>Produtos</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">User</th>
                        <th scope="col">Email</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->user->username }}</td>
                            <td>{{ $product->user->email }}</td>
                            <td>
                                <div class="w-25 d-inline-block" >
                                @can('update', $product)
                                    <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-primary">Editar</a>
                                @endcan
                                </div>
                                <div class="w-25 d-inline-block">
                                @can('delete', $product)
                                    <a href="#" class="btn btn-danger btn-delete" onclick="modal({{$key}})">Excluir</a>
                                @endcan
                                </div>
                                @include('products.delete', $product)
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$products->links()}}
        </div>
    </div>
</div>
<script>
    function modal(index)
    {
        let row = document.querySelectorAll('tr td')[index];
        columns = row.querySelectorAll('td');
        form = document.querySelectorAll('tr td form')[index];
        var data = []
        columns.forEach(function(e){
            data.push(e.innerText)
        });
        Swal.fire({
            title: 'Você tem certeza?',
            text: "Realmente deseja deletar o produto " + data[0] + "?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                ).then((confirm) => {
                    form.submit();
                })
            }
        })
    }
</script> 
@endsection