<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Marca;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //RETORNAMOS LISTA CON DATOS
        //PARA TRAER TODOS LOS REGISTROS
        //$marcas = Marca::all();

        //PARA TRAER TODOS LOS REGISTROS PAGINADOS DE A 5 POR PAGINA
        //CON LOS BOTONES 'ANTERIOR' Y 'SIGUIENTE'
        //$marcas = Marca::simplePaginate(5);

        //CON LOS NUMEROS DE PAGINAS
        $marcas = Marca::paginate(10);
        return view('Marcas.adminMarcas', ['marcas' => $marcas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Marcas.agregarMarca');
    }

    private function validateForm(Request $request)
    {
        //CREO REGLAS DE VALIDACION
        //ES REQUERIDO
        //MINIMO DE 2 LETRAS PARA EL NOMBRE
        //MAXIMO DE 30 LETRAS PARA EL NOMBRE
        $request->validate(
            [
                'mkNombre' => 'required|min:2|max:30|unique:marcas'
            ],
            [
                'mkNombre.required' => 'el campo "Nombre de la Marca" es requerido',
                'mkNombre.min' => 'el nombre debe tener al menos dos caracteres',
                'mkNombre.max' => 'el nombre puede tener un maximo de 30 caracteres',
                'mkNombre.unique' => 'la marca ya existe'
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
        $mkNombre = $request->mkNombre;

        //VALIDAR
        $this->validateForm($request);

        //INSTANCIACION, ASIGNACION, GUARDAR
        $Marca = new Marca;
        $Marca->mkNombre = $mkNombre;
        $Marca->save();

        //REDIRECCIONAR
        return redirect('adminMarcas')->with(['mensaje' => 'la marca se dio de alta correctamente','class'=>'success']);
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
        //OBTENER DATOS DE LA MARCA
        $Marca=Marca::find($id);
        //RETORNAMOS VISTA CON LOS DATOS DE LA MARCA
        return view('Marcas.modificarMarca', ['Marca' => $Marca]);
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
        $mkNombre=$request->mkNombre;

        //VALIDACIONES
        $this->validateForm($request);
        //OBTENEMOS LA MARCA POR EL ID
        $Marca=Marca::find($request->idMarca);
        //MODIFICO LOS VALORES
        $Marca->mkNombre=$mkNombre;
        //GUARDO NUEVOS VALORES
        $Marca->save();
        //REDIRECCIONO
        return redirect('adminMarcas')->with(['mensaje' => 'Marca: ' . $mkNombre.' la marca se modifico correctamente','class'=>'success']);
    }

    //VALIDO QUE HAYA O NO MARCAS EN LA TABLA PRODUCTOS
    private function productByMarca($idMarca){
        $check=Producto::where('idMarca',$idMarca)->count();
        return $check;
    }

    //para hacer la baja
    public function confirmarBaja($id)
    {
        //OBTENER DATOS DE LA MARCA
        $Marca=Marca::find($id);

        //VALIDO QUE HAYA O NO MARCAS EN LA TABLA PRODUCTOS
        //LLAMO AL METODO PRODUCBYMARCA
        if($this->productByMarca($id)==0){
            return view('Marcas.eliminarMarca',['Marca'=>$Marca]);
        }
        return redirect('/adminMarcas')
            ->with(['mensaje'=>'no se puede eliminar la marca: ' . $Marca->mkNombre . ' porque tiene productos asignados',
            'class'=>'danger']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $idMarca=$request->idMarca;
        $mkNombre=$request->mkNombre;

        //OPCION VALIDA PARA BORRAR
        //Marca::where('idMarca',$idMarca)->delete();
        Marca::destroy($idMarca);

        return redirect('/adminMarcas')
            ->with(['mensaje'=>'Marca: ' . $mkNombre . ' eliminada correctamente','class'=>'success']);
    }
}
