@extends('layouts.plantilla')

@section('contenido')


        <h1>Modificar producto</h1>

        <div class="alert bg-light border border-white shadow round col-8 mx-auto p-4">

            <form action="/modificarProducto" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                Nombre: <br>
                <input type="text" name="prdNombre" value="{{old('prdNombre',$Producto->prdNombre)}}" class="form-control">
                <br>
                Precio: <br>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="number" name="prdPrecio" value="{{old('prdPrecio',$Producto->prdPrecio)}}" class="form-control" step="0.01">
                </div>
                <br>
                Marca: <br>
                <select name="idMarca" class="form-control">
                    <option value="{{$Producto->idMarca}}">{{$Producto->relMarcas->mkNombre}}</option>
                    @foreach($marcas as $marca)
                    <option {{ ($marca->idMarca==old('idMarca'))?'selected':'' }}
                            value="{{$marca->idMarca}}">{{$marca->mkNombre}}</option>
                    @endforeach
                </select>
                <br>
                Categoría: <br>
                <select name="idCategoria" class="form-control">
                    <option value="{{$Producto->idCategoria}}">{{$Producto->relCategorias->catNombre}}</option>
                    @foreach($categorias as $categoria)
                    <option {{ ($categoria->idCategoria==old('idCategoria'))?'selected':'' }}
                            value="{{$categoria->idCategoria}}">{{$categoria->catNombre}}</option>
                    @endforeach
                </select>
                <br>
                Presentacion: <br>
                <textarea name="prdPresentacion" class="form-control">{{old('prdPresentacion',$Producto->prdPresentacion)}}</textarea>
                <br>
                Stock: <br>
                <input type="number" name="prdStock" value="{{old('prdStock',$Producto->prdStock)}}" class="form-control" min="0">
                <br>
                Imagen original: <br>
                 <img src="/productos/{{$Producto->prdImagen}}" alt="" class="img-thumbnail mb-3">
                <br>
                Modificar imagen (opcional)<br>

                <div class="custom-file mt-1 mb-4">
                    <input type="file" name="prdImagen"  class="custom-file-input" id="customFileLang" lang="es">
                    <label class="custom-file-label" for="customFileLang" data-browse="Buscar en disco">Seleccionar Archivo: </label>
                </div>
                <input type="hidden" name="idProducto" class="form-control" value="{{$Producto->idProducto}}">
                <br>
                <button class="btn btn-primary mb-3">Modificar Producto</button>
                <a href="/adminProductos" class="btn btn-outline-secondary mb-3">Volver al panel de Productos</a>
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

