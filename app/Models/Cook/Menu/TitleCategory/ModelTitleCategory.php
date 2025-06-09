<?php

namespace App\Models\Cook\Menu\TitleCategory;
use App\Models\Cook\Menu\ModelMenu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelTitleCategory extends Model
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

    // Relación con MenuCategoryItem
    public function menuCategory()
    {
        return $this->belongsTo(ModelMenu::class, 'letter', 'letter');
    }

    // Sobrescribir la función `getKeyName` para evitar problemas con claves compuestas
    public function getKeyName()
    {
        return 'id'; // Laravel solo admite claves primarias simples, por lo que puedes manejar `id` como clave principal lógica
    }
    public function setTitle()
    {
        
    }
    public function setDescription()
    {

    }
}
