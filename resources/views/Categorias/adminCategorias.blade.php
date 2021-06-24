@extends('layouts.plantilla')

    @section('contenido')

        <h1>Panel de administración de categorias</h1>

        @if ( session('mensaje') )
            <div class="alert alert-success">
                {{ session('mensaje') }}
            </div>
        @endif

        <table class="table table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Categoria</th>
                    <th colspan="2">
                        <a href="/agregarCategoria" class="btn btn-primary">
                            Agregar
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->idCategoria }}</td>
                    <td>{{ $categoria->catNombre}}</td>
                    <td>
                        <a href="/modificarCategoria/{{$categoria->idCategoria}}" class="btn btn-info">
                            Modificar
                        </a>
                    </td>
                    <td>
                        <a href="/eliminarCategoria/{{$categoria->idCategoria}}" class="btn btn-danger">
                            Eliminar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{$categorias->links()}}
    @endsection
