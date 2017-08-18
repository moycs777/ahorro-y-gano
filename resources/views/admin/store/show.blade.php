@extends('backLayout.app')
@section('title')
Store
@stop

@section('content')

    <h1>Store</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Name</th><th>Nif Cif</th><th>Category</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $store->id }}</td> <td> {{ $store->name }} </td><td> {{ $store->nif_cif }} </td><td> {{ $store->category }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection