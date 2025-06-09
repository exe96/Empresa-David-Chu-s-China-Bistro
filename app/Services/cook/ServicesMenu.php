<?php
namespace App\Services\cook;
use App\Models\Cook\Menu\ModelMenu;
use App\Models\Cook\Menu\TitleCategory\ModelTitleCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
Class ServicesMenu{
    /**
     * Obtiene el menú con todas las categorías.
     */
    public function get(){
        // Inicia el registro de la obtención del menú

        Log::info("ServicesMenu@get  Iniciando la obtención de menú ");
        // Intenta obtener el menú
        // y maneja cualquier excepción que pueda ocurrir
        try{
            $resuult=[
                // Obteniendo Menú
                'menu' => DB::table('menu_category_item as m')
                    ->select('m.name', 'm.letter','m.id','m.extension')
                    ->get()
            ];
            Log::info("ServicesMenu@get: Menú obtenido correctamente. Total categorías: " . count($resuult['menu']));
            Log::info('=================================================');
            return $resuult;
        }catch(\Exception $e){


            Log::error("ServicesMenu@get Error al obtener el menu en : " . $e->getMessage());
            Log::error('===================================================================');
            // Manejo de errores
            return [
                    'error' => 'The menu information could not be obtained at this time. Please try again later.'
                ];
            }
}
    public function createCategory($date){
        // inicia el registro de la creación de una categoría

        Log::info("ServicesMenu@createCategory  Iniciando la creación de una categoría");


        DB::beginTransaction();
        try{
            // Datos de la categoría
        $image = $date['img']??null;
        $extensionInput = $date['extension'];
        $name = strtoupper( $date['name']);
        $letter = strtoupper( $date['letter']);
        $title = $date['title'];
        $description = $date['description'];

        if ($image) {

        // Solo se modifica la foto
        $extension = $image->getClientOriginalExtension();
        $filename = $letter . '.' . $extension;
        // Ruta de carpeta relativa al disco 'public'
        $folder = 'public/menu/' . $letter . '/';
        // Buscar archivos existentes con el mismo nombre base (sin importar extensión)
        $archivosExistentes = Storage::disk('public')->files($folder);

        foreach ($archivosExistentes as $archivo) {
            if (pathinfo($archivo, PATHINFO_FILENAME) === $letter) {
                // Si se encuentra un archivo con el mismo nombre base, da error
                Log::warning('ServicesMenu@createCategory El archivo imagen ya existe: ' . $archivo);
                return [
                    'error' => 'There is already an image with the same name. Please choose another name.'
                ];
            }
        }

        // Guardar la imagen con ese nombre en el disco 'public'
        $path = $image->storeAs($folder, $filename, 'public');

        } else {
            $extensionInput = 4;
        }

        ModelMenu::create([
            'name' => $name,
            'letter' => $letter,
            'extension'=>$extensionInput
        ]);
        ModelTitleCategory::create([
            'title'=> $title,
            'description'=> $description,
            'letter'=> $letter
        ]);

        if(isset($path)){
            Log::info("ServicesMenu@createCategory: Imagen guardada exitosamente en la ruta: $path");
        }else{
            Log::info("ServicesMenu@createCategory: No se subió ninguna imagen, se guardó la categoría sin imagen.");
        }
        Log::info("ServicesMenu@createCategory: Categoría creada correctamente con la letra: $letter");
        Log::info('=================================================');
        // Commit the transaction
        DB::commit();
        // Retorna el mensaje de éxito
        return [
            'success' => 'Categoría creada correctamente!'
        ];

    }catch(\Exception $e){
        // Rollback the transaction in case of error
        DB::rollBack();
        Log::error('no se pudo crear la categoría: ' . $e->getMessage());
        Log::error('=================================================');

        return  [
                    'error' => 'Category could not be created'
                ];
        }


}
    public function updateCategory($data){
        //update category
        Log::info("ServicesMenu@updateCategory  Iniciando la actualización de una categoría");
        DB::beginTransaction();
        try {
        // Datos de la categoría
        $id = $data['modal-id'];
        $name = strtoupper($data['modal-name']?? null);
        $image = $data['modal-file']??null;
        $extensionInput = $data['extension'];
        $letter = strtoupper($data['modal-category']);
        $title = $data['modal-title']??null;
        $description = $data['modal-description']??null;
        // Verifica si la categoría existe
        $categoryExist = ModelMenu::findOrFail($id);
        // trae el modelo de título de categoría
        $titleCategory = $categoryExist->titleCategory;

        if($image){


             // Solo se modifica la foto
        $extension = $image->getClientOriginalExtension();
        $filename = $letter . '.' . $extension;
        // Ruta de carpeta relativa al disco 'public'
        $folder = 'public/menu/' . $letter . '/';
        // Buscar archivos existentes con el mismo nombre base (sin importar extensión)
        $archivosExistentes = Storage::disk('public')->files($folder);

        foreach ($archivosExistentes as $archivo) {
            if (pathinfo($archivo, PATHINFO_FILENAME) === $letter) {
                // Si se encuentra un archivo con el mismo nombre base, lo elimina
                Log::info('ServicesMenu@updateCategory El archivo imagen existe, eliminado imagen: ' . $archivo);
                //Storage::delete($archivo);
                Storage::disk('public')->delete($archivo);

            }
        }

        // Guardar la imagen con ese nombre en el disco 'public'
        $path = $image->storeAs($folder, $filename, 'public');

        if($extension=='jpeg'){
            $categoryExist->extension = 1;
            }else if($extension=='jpg'){
            $categoryExist->extension = 2;

        }else if($extension=='png'){
            $categoryExist->extension = 3;
        }
    }
        if($name && trim($name) !== ''){
            $categoryExist->name = $name;
        }
        if($title && trim($title) !== ''){
            $titleCategory->title = $title;
        }
        if($description && trim($description) !== ''){
            $titleCategory->description = $description;

        }
        $titleCategory->save();
        $categoryExist->save();
        // Actualizar la categoría en la base de datos
        Log::info("ServicesMenu@updateCategory: Categoría actualizada correctamente con la letra: $letter");
        Log::info('=================================================');
        // Commit the transaction
        DB::commit();
        return[
            'success' => 'Categoría actualizada correctamente!'
        ];
    }catch (\Exception $e) {
        // Rollback the transaction in case of error
        DB::rollBack();
        // Manejo de errores
        Log::error('no se pudo actualizar la categoría: ' . $e->getMessage());
        Log::error('=================================================');
        return  [
                    'error' => 'category could not be updated'
                ];
    }
    }
    /**
     * Elimina una categoría del menú.
     */
    public function deleteCategory($data){

        // Inicia el registro de la eliminación de una categoría
        Log::info("ServicesMenu@deleteCategory  Iniciando la eliminación de una categoría");
        DB::beginTransaction();
        // Intenta eliminar la categoría
        try{
            $id= $data['id'];
            $letter = strtoupper($data['letter']);
            // Verifica si la categoría existe
            $category = ModelMenu::findOrFail($id);
            $titleCategory = $category->titleCategory??null;
            $items= $category->items ?? null;
            if($titleCategory ==! null){
                // Elimina el titulo y descripcion del menú
                $titleCategory->delete();
            }
            if($items ==! null){
                // Elimina los items asociados a la categoría
                $items->each(function ($item) {
                // Elimina cada item asociado a la categoría
                $item->delete();
            });
            }
            // Elimina la categoría
            $category->delete();
            // Elimina el título de la categoría

            // Elimina los archivos asociados a la categoría
            Storage::disk('public')->deleteDirectory('menu/' . $letter);
            Log::info("ServicesMenu@deleteCategory: Categoría eliminada correctamente con la letra: $letter");
            Log::info('=================================================');
            // Commit the transaction
            DB::commit();
            // Retorna el mensaje de éxito
            return [
                'success' => 'Categoría eliminada correctamente!'
            ];
        }catch(\Exception $e){
            // Rollback the transaction in case of error
            DB::rollBack();
            Log::error('no se pudo eliminar la categoría: ' . $e->getMessage());
            Log::error('=================================================');
            return  [
                    'error' => 'category could not be removed'
                ];
        }
    }
    /**
     * Obtiene la lista de letras del menú.
     */
    public function getLetterDataList(){
        // Inicia el registro de la obtención de letras

        Log::info("ServicesMenu@getLetterDataList  Iniciando la obtención de letras ");

        // Intenta obtener las letras
        // y maneja cualquier excepción que pueda ocurrir
        try{
            $result=[
                // Obteniendo letras
                'letters' => DB::table('menu_category_item as m')
                    ->select('m.letter')
                    ->get()
            ];

            Log::info("ServicesMenu@getLetterDataList: Letras obtenidas correctamente. Total letras: " . count($result['letters']));



            // Retorna el resultado
            return $result;
        }catch(\Exception $e){

            Log::error("ServicesMenu@getLetterDataList-catch Error al obtener las letras en : " . $e->getMessage());

            // Manejo de errores
            return [
                    'error' => 'Could not get the information of the letters at this time'
                ];
            }
    }
}
