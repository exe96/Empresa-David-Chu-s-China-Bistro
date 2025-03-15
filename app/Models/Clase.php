<?php
namespace App\Models;  


use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $table = 'clase'; // Si el nombre de la tabla es diferente al nombre plural del modelo

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona', 'id');

    }
}
