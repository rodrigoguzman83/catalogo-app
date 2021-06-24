@extends('layouts.plantilla')

    @section('contenido')

        <h1>Modificar Categoria</h1>

        <div class="p-4 mx-auto border border-white shadow alert bg-light round col-8">

            <form action="/modificarCategoria" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="catNombre">Nombre de la categoria</label>
                    <input type="text" name="catNombre"
                           class="form-control" id="catNombre" value="{{old('catNombre',$Categoria->catNombre)}}">
                    <input type="hidden" name="idCategoria" class="form-control" value="{{$Categoria->idCategoria}}">
                </div>
                <button class="mr-3 btn btn-primary">Modificar categoria</button>
                <a href="/adminCategorias" class="btn btn-outline-secondary">
                    Volver a panel
                </a>
            </form>
        </div>

        {{--PARA MANEJAR LOS ERRORES--}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible col-8 mx-auto">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endsection

