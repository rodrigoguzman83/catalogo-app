<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $primaryKey='idProducto'; //PARA ESTABLECER CUAL ES EL CAMPO ID DE NUESTRO MODELO
    public $timestamps = false; //PARA DESACTIVAR UPDATE Y CREATE

    /*METODOS DE RELACIONES*/
    public function relMarcas(){
        return $this->belongsTo(
            Marca::class,
            'idMarca',
            'idMarca'
        );
    }

    public function relCategorias(){
        return $this->belongsTo(
            Categorias::class,
            'idCategoria',
            'idCategoria'
        );
    }
}
