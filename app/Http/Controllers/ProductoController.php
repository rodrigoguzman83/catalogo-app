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
        $productos=Producto::with('relMarcas')->paginate(5);
        return view('Productos.adminProductos',['productos'=>$productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //OBTENER LISTADO DE MARCAS Y CATEGORIAS PARA LUEGO PASARLOS A LA VISTA DE AGREGAR PRODUCTO
        $marcas=Marca::all();
        $categorias=Categorias::all();
        return view('Productos.agregarProducto',['marcas'=>$marcas,'categorias'=>$categorias]);
    }

    /*FUNCION PARA VALIDAR*/
    private function validateForm(Request $request){
        $request->validate(
            [
                'prdNombre'=>'required|min:3|max:70',
                'prdPrecio'=>'required|numeric|min:0',
                'idMarca'=>'required',
                'idCategoria'=>'required',
                'prdPresentacion'=>'required|min:3|max:150',
                'prdStock'=>'required|integer|min:1',
                'prdImagen'=>'mimes:jpg,jpeg,png,gif,svg,webp|max:2048'
            ],
            [
                'prdNombre.required'=>'Complete el campo Nombre',
                'prdNombre.min'=>'Complete el campo Nombre con al menos 3 caractéres',
                'prdNombre.max'=>'Complete el campo Nombre con 70 caractéres como máxino',
                'prdPrecio.required'=>'Complete el campo Precio',
                'prdPrecio.numeric'=>'Complete el campo Precio con un número',
                'prdPrecio.min'=>'Complete el campo Precio con un número positivo',
                'idMarca.required'=>'Selecciona una marca',
                'idCategoria.required'=>'Selecciona una categoría',
                'prdPresentacion.required'=>'Complete el campo Presentación',
                'prdPresentacion.min'=>'Complete el campo Presentación con al menos 3 caractéres',
                'prdPresentacion.max'=>'Complete el campo Presentación con 150 caractérescomo máxino',
                'prdStock.required'=>'Complete el campo Stock',
                'prdStock.integer'=>'Complete el campo Stock con un número entero',
                'prdStock.min'=>'Complete el campo Stock con un número positivo',
                'prdImagen.mimes'=>'Debe ser una imagen',
                'prdImagen.max'=>'Debe ser una imagen de 2MB como máximo'
            ]
        );
    }

    /*FUNCION PARA SUBIR IMAGEN*/
    private function uploadImage(Request $request){
        //SI NO ENVIARON ARCHIVO
        $prdImagen='noDisponible.jpg';

        //SI ENVIARON ARCHIVO
        //RENOMBRAR
        //SUBIR
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
        $prdImagen=$this->uploadImage($request);

        return 'imagen:' . $prdImagen;
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
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
