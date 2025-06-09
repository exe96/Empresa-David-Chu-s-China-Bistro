<?php
namespace App\Http\Controllers\cooking;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cook\Item\RequestItemCreate;
use App\Http\Requests\Cook\Item\RequestItemUpadate;
use App\Http\Requests\Cook\Item\RequestItemDelete;
use App\Services\cook\ServicesItems;
use App\Services\cook\ServicesMenu;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
class CrudItemController extends Controller{


       // Método para obtener un ítem específico del menú
    public function showFood(ServicesMenu $menu,ServicesItems $items,$food){

        Log::info('CrudItemController@showFood  Iniciando la obtención de Food específico: ' . $food);
        // Verifica si la food existe en el menú, consumiendo el servicio
        $result=$items->findFood($menu,$food);
        // Si no se encuentra la food, muestra un mensaje de error
        if(!$result['found']){
            // Muestra la vista  con un mensaje de error
            return view('cook.items.itemsError', ['message' => $result['error']]);
        }

        $foodDetails = $items->getId($food);
        return view('cook.items.menuItemComplete', ['foodDetails'=>$foodDetails,'food'=>$food]);
    }

// Crear un ítem
    public function createItem(RequestItemCreate $request, ServicesItems $createItem) {
    $data = $request->validated();
    Log::info('=================================================');
    Log::info('CrudItemController@createItem Iniciando la creación de un ítem');

    $proces=$createItem->createItem($data);
            if (isset($proces['error'])) {
                // Muestra una vista de error
                return back()->withErrors($proces['error'])->withInput();
            }
            return back()->with('success', 'Item created successfully!');

        }

//  Actualizar un ítem
    public function updateItem(RequestItemUpadate $request, ServicesItems $servicesItems) {
        $data = $request->validated();
        Log::info("CrudItemController@updateItem  Iniciando la actualización de una Item");
        $proces = $servicesItems->updateItem($data);
        if (isset($proces['error'])) {
            // Muestra una vista de error
            return back()->withErrors($proces['error']);
        }
        return back()->with('success', 'Item updated successfully!');
}

//  Eliminar un ítem
    public function deleteItem(RequestItemDelete $request, ServicesItems $deleteItem) {
        $data = $request->validated();
        Log::info('=================================================');
        Log::info("CrudItemController@deleteItem :  Iniciando la eliminación de un Item");

        $proces=$deleteItem->deleteItem($data);
        if (isset($proces['error'])) {
            // Muestra una vista de error
            return back()->withErrors($proces['error']);
        }
        return back()->with('success', 'Item removed successfully!');
}


}
