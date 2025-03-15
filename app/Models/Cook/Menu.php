<?php
namespace App\Models\Cook; 
use Illuminate\Support\Facades\DB;
class Menu{
    public static function getMenu(){
      return[
      
        'menuItems' => DB::table('menu_category_item as m')
                ->select('m.name', 'm.letter','m.id','m.extension')
                ->get()
      ];
            }
}
