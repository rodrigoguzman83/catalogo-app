<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use mysql_xdevapi\Table;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categorias = Categorias::paginate(5);
        return view('Categorias.adminCategorias', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Categorias.agregarCategoria');
    }

    private function validateForm(Request $request)
    {
        //CREO REGLAS DE VALIDACION
        //ES REQUERIDO
        //MINIMO DE 2 LETRAS PARA EL NOMBRE
        //MAXIMO DE 30 LETRAS PARA EL NOMBRE
        //QUE NO SE INGRESE UN VALOR YA EXISTENTE EN LA BDD
        $request->validate(
            [
                'catNombre' => 'required|min:2|max:30|unique:categorias'
            ],
            [
                'catNombre.required' => 'el campo "Nombre de Categoria" es requerido',
                'catNombre.min' => 'el nombre debe tener al menos dos caracteres',
                'catNombre.max' => 'el nombre puede tener un maximo de 30 caracteres',
                'catNombre.unique' => 'el nombre ya existe'
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //CAPTURAR LO QUE SE ENVIA A TRAVES DEL FORM
        $catNombre = $request->catNombre;

        //VALIDAR
        $this->validateForm($request);

        //INSTANCIACION, ASIGNACION, GUARDAR
        $Categoria = new Categorias;
        $Categoria->catNombre = $catNombre;
        $Categoria->save();

        //REDIRECCIONAR
        return redirect('adminCategorias')->with(['mensaje' => 'la categoria se dio de alta correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Categoria=Categorias::find($id);
        return view('Categorias.modificarCategoria',['Categoria'=>$Categoria]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //GUARDO EL NUEVO VALOR ENVIADO DESDE EL FORM
        $catNombre=$request->catNombre;

        //VALIDO EL NUEVO VALOR
        $this->validateForm($request);

        //BUSCO EL REGISTRO A MODIFICAR POR SU ID
        $Categoria=Categorias::find($request->idCategoria);

        //MODIFICO EL O LOS CAMBIOS A TRAVES DE LAS PROPIEDADES DEL MODEL
        $Categoria->catNombre=$catNombre;

        //GUARDO EL O LOS CAMBIOS REALIZADOS
        $Categoria->save();

        //REDIRECCIONO A LA VISTA PRINCIPAL CON UN MENSAJE
        return redirect('adminCategorias')->with(['mensaje'=>'La categoria ' . $catNombre . ' ha sido modificada con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
