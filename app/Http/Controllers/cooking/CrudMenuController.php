<?php
namespace App\Http\Controllers\cooking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cook\Item;
use App\Services\cook\ServicesMenu;
use App\Services\cook\ServicesItems;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Cook\Menu\RequestMenuCreate;
use App\Http\Requests\Cook\Menu\RequestMenuUpdate;
use App\Http\Requests\Cook\Menu\RequestMenuDelete;

use function Laravel\Prompts\progress;

class CrudMenuController extends Controller{

    protected $defaultFolder = 'storage/public/menu';
    protected $defaultPhoto = 'menu';
    protected $defaultExtension = 'jpg';
    // Método para obtener el menú
    public function showMenu(ServicesMenu $showMenu){
        Log::info('=================================================');
        Log::info('ClassController@showMenu  Iniciando la obtención de menú ');

        // Intenta obtener el menú
        $menu=$showMenu->get();

        if (isset($menu['error'])) {

                // Muestra una vista de error
                return view('cook.menu.menuError', ['message' => $menu['error']]);
            }

            // Muestra la vista con el menú
            return view('cook.menu.menu',['menu'=>$menu['menu']]);

    }

 //  Crear nueva categoría
    public function createCategory(RequestMenuCreate $request, ServicesMenu $createCategory){
        $data = $request->validated();
        //validación de servicio
        Log::info('=================================================');
        Log::info("CrudMenuController@createCategory  Iniciando la creación de una categoría");

        $proces=$createCategory->createCategory($data);
        if (isset($proces['error'])) {
            // Muestra una vista de error
            return back()->withErrors($proces['error'])->withInput();
        }
        return back()->with('success', 'Category created successfully!');
        /* back()->withErrors('error al crear categoría' . $e->getMessage())->withInput() */
    }
//  Editar categoría
    public function updateMenu(RequestMenuUpdate $request, ServicesMenu $updateMenu){
        Log::info('=================================================');
        Log::info("CrudMenuController@updateMenu  Iniciando la actualización de una categoría");
        $data = $request->validated();
        //validación de servicio
        $proces=$updateMenu->updateCategory($data);
        if (isset($proces['error'])) {
            // Muestra una vista de error
            return back()->withErrors($proces['error']);
        }
        return back()->with('success', 'Category updated successfully!');

    }

//  Eliminar categoría
    public function deleteCategory(RequestMenuDelete $request, ServicesMenu $deleteCategory){
        $data = $request->validated();
        Log::info('=================================================');
        Log::info("CrudMenuController@deleteCategory  Iniciando la eliminación de una categoría");

        $proces=$deleteCategory->deleteCategory($data);
        if (isset($proces['error'])) {
            // Muestra una vista de error
            return back()->withErrors($proces['error']);
        }
        return back()->with('success', 'Category removed successfully!');

}
    public function getLetterDataList(ServicesMenu $getLetterDataList){
        // Inicia el registro de la obtención de letras
        Log::info('=================================================');
        Log::info("CrudMenuController@getLetterDataList  Iniciando la obtención de letras");
        Log::info('=================================================');
        // Intenta obtener las letras
        $result=$getLetterDataList->getLetterDataList();
        if (isset($result['error'])) {
            // Muestra una vista de error
            return view('cook.menu.menuError', ['message' => $result['error']]);
        }
        // Muestra la vista con las letras
        return view('cook.menu.menu',['letters'=>$result['letters']]);

    }

    public function getLetterDataListAsync(ServicesMenu $getLetterDataList){

        Log::info('=================================================');
        Log::info("CrudMenuController@getLetterDataListAsync:  Iniciando la obtención de letras");

        $letters=$getLetterDataList->getLetterDataList();
        return response()->json($letters);

    }


}


