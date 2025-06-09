<?php
namespace App\Services\cook;
use App\Models\Cook\items\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

Class ServicesItems{
    // Obtener el item de una categoría
    /**
     * Obtiene los elementos de una categoría específica, con su título y descripción.
     */
    public function getId($food){


        Log::info("ServicesItems@getId Iniciando la obtención de items, para la categoría: $food ");

        // Intenta obtener los elementos de la categoría
        try {
            $result = [
                // Obtener el título y la descripción de la categoría
                'title' => DB::table('menu_category_item as m')
                    ->select('t.title', 't.description')
                    ->join('title_items as t', 'm.letter', '=', 't.letter')
                    ->where('m.letter', $food)
                    ->get(),
                // Obtener los elementos de la categoría
                'items' => DB::table('menu_category_item as m')
                    ->select('s.name as extension', 'i.title as name', 'i.description', 'i.number', 'i.price', 'i.id')
                    ->join('item as i', 'm.letter', '=', 'i.letter')
                    ->join('soported_extension as s', 's.id', '=', 'i.extension')
                    ->where('m.letter', $food)
                    ->orderBy('i.number', 'asc')
                    ->get()
            ];

            Log::info("ServicesItems@getId: Items obtenidos correctamente para la categoría $food. Total items: " . count($result['items']));
            Log::info("==================================================================");
            return $result;
        } catch (\Exception $e) {
            // Manejo de errores

            Log::error("ServicesItems@getId-catch Error al obtener los elementos de la categoría $food: " . $e->getMessage());
            Log::error("==================================================================");
            // Retorna un mensaje de error
            return [
                'error' => 'Could not obtain category information at this time please try later.'
            ];
        }
    }
    /**
     * Se encarga de buscar si existe un alimento específico en el menú.
     * Si no existe, se devuelve un mensaje de error.
     * @param  $menu  collection de letras
     * @param  $food  nombre del alimento a buscar
     */
    public function findFood($menu,$food){

        Log::info("ServicesItems@findFood Iniciando la búsqueda  de comida: $food");

        session_start();
        if(!isset($_SESSION['collection'])){
        // Si la colección no está definida, la inicializamos
        // Obtenemos la lista de letras del menú
        $menuDataList=$menu->getLetterDataList();
        $menuCollection=[];
        foreach($menuDataList['letters'] as $item){
            // Agregamos cada letra a la colección
            foreach($item as $key => $value){

                array_push($menuCollection,$value);

            }


        }
        $_SESSION['collection']=$menuCollection;
        }
        if (!in_array($food, $_SESSION['collection'])) {

        Log::warning("No se encontró la comida: $food");


        unset($_SESSION['collection']);
        return [
            'found' => false,
            'error' => 'Not found that specific food, try again'
        ];
    }
        Log::info("se encontró la comida: $food");
        unset($_SESSION['collection']);
        return ['found' => true];
    }

    public function createItem($date){

        Log::info('ServicesItems@createItem Iniciando la creación de un item');
         // Datos del item
        $title = $date['title'];
        $description = $date['description']?? null;
        $price = $date['price'];
        $extensionInput = $date['extension'];
        $letter = strtoupper( $date['letter']);
        $number = $date['number'];
        $image = $date['img']??null;

        try{
        if ($image) {

        // Solo se modifica la foto
        $extension = $image->getClientOriginalExtension();
        $filename = $letter .$number.'.' . $extension;
        // Ruta de carpeta relativa al disco 'public'
        $folder = 'public/menu/' . $letter . '/';
        // Buscar archivos existentes con el mismo nombre base (sin importar extensión)
        $archivosExistentes = Storage::disk('public')->files($folder);

        foreach ($archivosExistentes as $archivo) {
            if (pathinfo($archivo, PATHINFO_FILENAME) === $letter. $number) {
                // Si se encuentra un archivo con el mismo nombre base, da error
                Log::warning('ServicesItem@createItem El archivo imagen ya existe: ' . $archivo);
                return [
                    'error' => 'There is already an image with that name, please rename the file.'
                ];
            }
        }

        // Guardar la imagen con ese nombre en el disco 'public'
        $path = $image->storeAs($folder, $filename, 'public');

        } else {
            $extensionInput = 4;
        }
        $title = $date['title'];
        $description = $date['description']?? null;
        $price = $date['price'];
        $extensionInput = $date['extension'];
        $letter = strtoupper( $date['letter']);
        $number = $date['number'];
        $image = $date['img']??null;

        Item::create([
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'extension'=>$extensionInput,
            'letter' => $letter,
            'number' => $number
        ]);

        if(isset($path)){
            Log::info("ServicesItems@createItem: Imagen guardada exitosamente en la ruta: $path");
        }else{
            Log::info("ServicesItems@createItem: No se subió ninguna imagen, se guardó el item sin imagen.");
        }
        Log::info("ServicesItems@createItem: Item creada correctamente con la letra: $letter");
        Log::info('=================================================');
        return [
            'success' => 'Item created successfully!'
        ];
    }catch(\Exception $e){
        Log::error('ServicesItems@createItem: no se pudo crear el Item: ' . $e->getMessage());
        Log::error('=================================================');
        return  [
                    'error' => 'could not create the item'
                ];
        }


}

    public function updateItem($data){

        Log::info("ServicesItems@updateItem  Iniciando la actualización de un item");
        try {
        // Datos de la item
        $id = $data['id'];
        $title = $data['title']??null;
        $description = $data['description']??null;
        $price = $data['price']??null;
        $image = $data['img']??null;
        $extensionInput = $data['extension'];
        $letter = strtoupper($data['letter']);
        $number = $data['number'];
        // Verifica si la categoría existe
        $itemExist = Item::findOrFail($id);
        // trae el modelo de item

        if($image){


             // Solo se modifica la foto
        $extension = $image->getClientOriginalExtension();
        $filename = $letter .$number .'.' . $extension;
        // Ruta de carpeta relativa al disco 'public'
        $folder = 'public/menu/' . $letter . '/';
        // Buscar archivos existentes con el mismo nombre base (sin importar extensión)
        $archivosExistentes = Storage::disk('public')->files($folder);

        foreach ($archivosExistentes as $archivo) {
            if (pathinfo($archivo, PATHINFO_FILENAME) === $letter.$number) {
                // Si se encuentra un archivo con el mismo nombre base, lo elimina
                Log::info('ServicesItems@updateItem El archivo imagen existe, eliminado imagen: ' . $archivo);
                //Storage::delete($archivo);
                Storage::disk('public')->delete($archivo);

            }
        }

        // Guardar la imagen con ese nombre en el disco 'public'
        $path = $image->storeAs($folder, $filename, 'public');

        if($extension=='jpeg'){
            $itemExist->extension = 1;
            }else if($extension=='jpg'){
            $itemExist->extension = 2;

        }else if($extension=='png'){
            $itemExist->extension = 3;
        }
    }
        if($title && trim($title) !== '' && $title !== $itemExist->title){
            // Si el título no está vacío y es diferente al actual, se actualiza
            Log::info("ServicesItems@updateItem: Actualizando el título del item con ID: $id");
            $itemExist->title = $title;
        }

    if($description && trim($description) !== '' && $description !== $itemExist->description){
            // Si la descripción no está vacía y es diferente a la actual, se actualiza
            Log::info("ServicesItems@updateItem: Actualizando la descripción del item con ID: $id");
            $itemExist->description = $description;

        }
        if($price && $price !== $itemExist->price){
            // Si el precio no está vacío y es diferente al actual, se actualiza
            Log::info("ServicesItems@updateItem: Actualizando el precio del item con ID: $id");
            $itemExist->price = $price;
        }

        $itemExist->save();
        // Actualizar la categoría en la base de datos
        Log::info("ServicesItems@updateItem: Item actualizado correctamente, correspondiente a la categoria: $letter");
        Log::info('=================================================');
        return[
            'success' => 'Categoría actualizada correctamente!'
        ];
    }catch (\Exception $e) {
        Log::error('ServicesItems@updateItem no se pudo actualizar el item: ' . $e->getMessage());
        Log::error('=================================================');
        return  [
                    'error' => 'could not update item'
                ];
    }
    }
    public function deleteItem($data){

        // Inicia el registro de la eliminación de una categoría
        Log::info("ServicesItemsu@deleteItem  Iniciando la eliminación de un Item  con ID: ".$data['id']);
        try{
            $id= $data['id'];

            // Verifica si la categoría existe
            $item = Item::findOrFail($id);
            $letter = $item->letter;
            $number = $item->number;
            $archivo = $letter . $number . '.' . $item->extension;

            $item->delete();
            // Elimina el archivo de imagen asociado al item
            if (Storage::disk('public')->exists('menu/' . $letter . '/' . $archivo)) {
                // Elimina el item de la base de datos
            Log::info("ServicesItems@deleteItem: Eliminando el item con ID: $id y letra: $letter");
            Storage::disk('public')->delete('menu/' . $letter . '/' . $archivo);
            Log::info("Archivo eliminado correctamente: menu/$letter/$archivo");
            } else {
                Log::warning("ServicesItems@deleteItem:Archivo no encontrado: menu/$letter/$archivo");
            }


            Log::info("ServicesItems@deleteItem: Categoría eliminada correctamente con la letra: $letter");
            Log::info('=================================================');
            return [
                'success' => 'Categoría eliminada correctamente!'
            ];
        }catch(\Exception $e){
            Log::error('ServicesItems@deleteItem: no se pudo eliminar el Item: ' . $e->getMessage());
            Log::error('=================================================');
            return  [
                    'error' => 'Could not delete the item'
                ];
        }

    }

}
