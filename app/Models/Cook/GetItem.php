<?php 
namespace App\Models\Cook;  
use Illuminate\Support\Facades\DB;
//Query Builder

class Getitem{
    public static function getFoodDetails($food)
    {
        return [
            'titles' => DB::table('menu_category_item as m')
                ->select('t.title', 't.description')
                ->join('title_items as t', 'm.letter', '=', 't.letter')
                ->where('m.letter', $food)
                ->get(),

            'items' => DB::table('menu_category_item as m')
                ->select('s.name as extension', 'i.title as name', 'i.description', 'i.number', 'i.price' ,'i.id')
                ->join('item as i', 'm.letter', '=', 'i.letter')
                ->join('soported_extension as s', 's.id', '=', 'i.extension')
                ->where('m.letter', $food)
                ->orderBy('i.number', 'asc') // Ordenar por i.number de menor a mayor
                ->get()
        ];
    }
}