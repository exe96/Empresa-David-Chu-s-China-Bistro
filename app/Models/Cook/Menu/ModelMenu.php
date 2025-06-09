<?php
namespace App\Models\Cook\Menu;
use App\Models\Cook\Menu\TitleCategory\ModelTitleCategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Cook\Items\Item;
use Illuminate\Database\Eloquent\Model;


class ModelMenu extends Model
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
    public function getItems(){
        return $this->hasOne(item::class, 'letter', 'letter');
    }
    public function titleCategory(){
    return $this->hasOne(ModelTitleCategory::class, 'letter', 'letter');
}

}
