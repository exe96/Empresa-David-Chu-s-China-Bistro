<?php

namespace App\Models\Cook;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitleItem extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'title_items';

    // Clave primaria compuesta
    protected $primaryKey = ['id', 'letter'];
    public $incrementing = false; // Laravel no maneja claves compuestas automáticamente

    // Campos permitidos para asignación masiva
    protected $fillable = ['title', 'description', 'letter'];

    // Deshabilitar timestamps si la tabla no tiene `created_at` y `updated_at`
    public $timestamps = false;

    // Relación con MenuCategoryItem (asumiendo que el modelo se llama así)
    public function menuCategoryItem()
    {
        return $this->belongsTo(MenuCategoryItem::class, 'letter', 'letter');
    }

    // Sobrescribir la función `getKeyName` para evitar problemas con claves compuestas
    public function getKeyName()
    {
        return 'id'; // Laravel solo admite claves primarias simples, por lo que puedes manejar `id` como clave principal lógica
    }
}
