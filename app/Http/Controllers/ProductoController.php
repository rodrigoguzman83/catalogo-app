<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$productos=Producto::paginate(5);
        $productos = Producto::with('relMarcas')->paginate(5);
        return view('Productos.adminProductos', ['productos' => $productos]);
    }

    //FUNCION QUE TRAE LOS PRODUCTOS PARA LA PORTADA
    public function getAllProducts()
    {
        $productos = Producto::with('relMarcas', 'relCategorias')->paginate(6);
        return view('portada', ['productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //OBTENER LISTADO DE MARCAS Y CATEGORIAS PARA LUEGO PASARLOS A LA VISTA DE AGREGAR PRODUCTO
        $marcas = Marca::all();
        $categorias = Categorias::all();
        return view('Productos.agregarProducto', ['marcas' => $marcas, 'categorias' => $categorias]);
    }

    /*FUNCION PARA VALIDAR*/
    private function validateForm(Request $request)
    {
        $request->validate(
            [
                'prdNombre' => 'required|min:3|max:70',
                'prdPrecio' => 'required|numeric|min:0',
                'idMarca' => 'required',
                'idCategoria' => 'required',
                'prdPresentacion' => 'required|min:3|max:150',
                'prdStock' => 'required|integer|min:1',
                'prdImagen' => 'mimes:jpg,jpeg,png,gif,svg,webp|max:2048'
            ],
            [
                'prdNombre.required' => 'Complete el campo Nombre',
                'prdNombre.min' => 'Complete el campo Nombre con al menos 3 caractéres',
                'prdNombre.max' => 'Complete el campo Nombre con 70 caractéres como máxino',
                'prdPrecio.required' => 'Complete el campo Precio',
                'prdPrecio.numeric' => 'Complete el campo Precio con un número',
                'prdPrecio.min' => 'Complete el campo Precio con un número positivo',
                'idMarca.required' => 'Selecciona una marca',
                'idCategoria.required' => 'Selecciona una categoría',
                'prdPresentacion.required' => 'Complete el campo Presentación',
                'prdPresentacion.min' => 'Complete el campo Presentación con al menos 3 caractéres',
                'prdPresentacion.max' => 'Complete el campo Presentación con 150 caractérescomo máxino',
                'prdStock.required' => 'Complete el campo Stock',
                'prdStock.integer' => 'Complete el campo Stock con un número entero',
                'prdStock.min' => 'Complete el campo Stock con un número positivo',
                'prdImagen.mimes' => 'Debe ser una imagen',
                'prdImagen.max' => 'Debe ser una imagen de 2MB como máximo'
            ]
        );
    }

    /*FUNCION PARA SUBIR IMAGEN*/
    private function uploadImage(Request $request)
    {
        //SI NO ENVIARON ARCHIVO
        $prdImagen = 'noDisponible.jpg';

        //SI ENVIARON ARCHIVO
        if ($request->file('prdImagen')) {
            //PARA OBTENER LA EXTENSION DEL ARCHIVO
            $extension = $request->file('prdImagen')->extension();

            //RENOMBRAR
            $prdImagen = time() . '.' . $extension;

            //SUBIR
            $request->file('prdImagen')->move(public_path('productos/'), $prdImagen);
        }
        return $prdImagen;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //LLAMO A LA FUNCION DE VALIDACION
        $this->validateForm($request);

        //SUBIR LA IMAGEN
        $prdImagen = $this->uploadImage($request);

        //INSTANCIAR
        $Producto = new Producto;

        //ASIGNAR
        $Producto->prdNombre = $request->prdNombre;
        $Producto->prdPrecio = $request->prdPrecio;
        $Producto->idMarca = $request->idMarca;
        $Producto->idCategoria = $request->idCategoria;
        $Producto->prdPresentacion = $request->prdPresentacion;
        $Producto->prdStock = $request->prdStock;
        $Producto->prdImagen = $prdImagen;

        //GUARDAR
        $Producto->save();

        //REDIRECCIONO CON MENSAJE OK
        return redirect('adminProductos')->with(['mensaje' => 'Producto agregado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //BUSCO EL PRODUCTO Y ADEMAS ME TRAIGO LOS CAMPOS RELACIONADOS
        $Producto = Producto::with('relMarcas', 'relCategorias')->find($id);

        //BUSCO LAS MARCAS
        $marcas = Marca::all();

        //BUSCO LAS CATEGORIAS
        $categorias = Categorias::all();

        //RETORNAMOS VISTA CON LOS DATOS DE LA MARCA
        return view('Productos.modificarProducto', ['Producto' => $Producto, 'marcas' => $marcas, 'categorias' => $categorias]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $productName = $request->prdNombre;
        //VALIDO LOS DATOS
        $this->validateForm($request);

        //VALIDO LA IMAGEN
        $prdImagen = $this->uploadImage($request);

        //OBTENGO LOS DATOS DEL REGISTRO A MODIFICAR
        $Producto = Producto::find($request->idProducto);

        $imagen = $Producto->prdImagen;


        //MODIFICO LOS DATOS DEL REGISTRO
        $Producto->prdNombre = $request->prdNombre;
        $Producto->prdPrecio = $request->prdPrecio;
        $Producto->idMarca = $request->idMarca;
        $Producto->idCategoria = $request->idCategoria;
        $Producto->prdPresentacion = $request->prdPresentacion;
        $Producto->prdStock = $request->prdStock;
        if ($imagen != 'noDisponible.jpg' && $prdImagen == 'noDisponible.jpg') {
            $Producto->prdImagen = $imagen;
        } else {
            $Producto->prdImagen = $prdImagen;
        }

        //GUARDO LOS DATOS
        $Producto->save();

        //REDIRECCIONO A LA PAGINA PRINCIPAL DE PRODUCTOS
        return redirect('adminProductos')->with(['mensaje' => 'El producto ' . $productName . ' fue modificado con exito']);
    }

    //PARA MOSTRAR EL PRODUCTO QUE SE VA A ELIMINAR
    public function confirmarBaja($id)
    {
        $Producto = Producto::with('relMarcas', 'relCategorias')->find($id);

        return view('Productos.eliminarProducto', ['Producto' => $Producto]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $idProducto = $request->idProducto;
        $prdNombre = $request->prdNombre;

        Producto::destroy($idProducto);

        return redirect('/adminProductos')
            ->with(['mensaje' => 'Producto: ' . $prdNombre . ' eliminado correctamente']);
    }
}
