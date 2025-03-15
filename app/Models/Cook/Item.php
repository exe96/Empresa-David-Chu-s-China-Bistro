<?php
namespace App\Models\Cook;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cook\MenuCategoryItem;
class Item extends Model
{
    use HasFactory;
    
    protected $table = 'item';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    
    protected $fillable = [
        'extension',
        'price',
        'title',
        'description',
        'letter',
        'number'
    ];
    
    public function category()
    {
        return $this->belongsTo(MenuCategoryItem::class, 'letter', 'letter');
    }
}