<?php
namespace App\Models\Cook; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Cook\Item;
use Illuminate\Database\Eloquent\Model;


class MenuCategoryItem extends Model
{
    use HasFactory;
    
    protected $table = 'menu_category_item';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'letter',
        'extension'
    ];
    
    public function items()
    {
        return $this->hasMany(Item::class, 'letter', 'letter');
    }
}