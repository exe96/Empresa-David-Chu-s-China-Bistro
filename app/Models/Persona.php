<?php
namespace App\Models;    
use Illuminate\Foundation\Auth\User as Authenticatable;


class Persona extends Authenticatable{


 // Indica el nombre de la tabla si es diferente a "personas"
    protected $table = 'persona';

    


  // Campos permitidos para llenar
    protected $fillable = [
    'nombre', 
    'apellido', 
    'email', 
    'password', 
    'edad',
    // Agrega todos los campos que tiene tu tabla
];
   // Asegúrate de que la contraseña esté oculta cuando se serialice el modelo
    protected $hidden = [
    'password',
];
public $timestamps = false;

}



