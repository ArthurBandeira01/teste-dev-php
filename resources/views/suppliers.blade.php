@extends('layouts')

@section('content')
<div class="container">
    <h1 class="my-4">Lista de Fornecedores</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Documento</th>
                <th scope="col">Cidade</th>
                <th scope="col">UF</th>
                <th scope="col">Criado em</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <th scope="row">{{ $supplier->id }}</th>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>{{ $supplier->document }}</td>
                    <td>{{ $supplier->city }}</td>
                    <td>{{ $supplier->state }}</td>
                    <td>{{ $supplier->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between">
        <div>
            <p>Mostrando {{ $suppliers->firstItem() }} a {{ $suppliers->lastItem() }} de {{ $suppliers->total() }} fornecedores</p>
        </div>
        <div>
            {{ $suppliers->links() }}
        </div>
    </div>
</div>
@endsection
