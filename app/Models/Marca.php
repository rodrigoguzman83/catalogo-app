<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    protected $primaryKey='idMarca'; //PARA ESTABLECER CUAL ES EL CAMPO ID DE NUESTRO MODELO
    public $timestamps = false; //PARA DESACTIVAR UPDATE Y CREATE
}
