@extends('layouts.plantilla')

    @section('contenido')

        <h1>Alta de una nueva marca</h1>

        <div class="alert bg-light border border-white shadow round col-8 mx-auto p-4">

            <form action="/agregarMarca" method="post">
                @csrf
                <div class="form-group">
                    <label for="mkNombre">Nombre de la marca</label>
                    <input type="text" name="mkNombre" value="{{old('mkNombre')}}"
                           class="form-control" id="mkNombre">
                </div>
                <button class="btn btn-primary mr-3">Agregar marca</button>
                <a href="/adminMarcas" class="btn btn-outline-secondary">
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

