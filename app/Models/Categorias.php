<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;
    protected $primaryKey='idCategoria'; //PARA ESTABLECER CUAL ES EL CAMPO ID DE NUESTRO MODELO
    public $timestamps = false;
}
