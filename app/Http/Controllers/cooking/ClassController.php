<?php
namespace App\Http\Controllers\cooking;
use App\Models\Cook\MenuCategoryItem;
use App\Http\Controllers\Controller;
use App\Models\Cook\Getitem;
use App\Models\Cook\Menu;
use App\Models\Cook\TitleItem;
use Illuminate\Http\Request;
use App\Models\Cook\Item;
use Illuminate\Http\Response;

use Exception;
use Laravel\Pail\ValueObjects\Origin\Console;

class ClassController extends Controller{


    function getMenu(){
      $menu=Menu::getMenu();
      return view('menu.menu',['menu'=>$menu['menuItems']]);
    }
    function getFood($food){
      session_start();
      if(!isset($_SESSION['collection'])){
        $menu=Menu::getMenu();
        $menuCollection=[];
        foreach($menu['menuItems'] as $item){
          array_push($menuCollection,$item->letter);
        }
        $_SESSION['collection']=$menuCollection;
      }
      if (!in_array($food, $_SESSION['collection'])) {
          //cambiar vista
        return response('No se encontró esa comida específica, vuelve a intentar');
    }

      $foodDetails = Getitem::getFoodDetails($food);

      unset($_SESSION['collection']);
      /* return response()->json($foodDetails); */
        return view('items.menuItemComplete', ['foodDetails'=>$foodDetails,'food'=>$food]);
    }

    static public function modifyCategory(Request $request){
      //update category
      try {
      $request->validate([
        'modal-file' => 'nullable|image|mimes:jpeg,png,jpg|max:5120|required_without:modal-name',
        'modal-category' => 'required|string',
        'modal-id' => 'required|integer',
        'modal-name'=>'nullable|string|required_without:modal-file',
        'extension' => 'required|integer|exists:soported_extension,id'
    ]);
// Obtén el archivo y el nombre
/* if (!$request->hasFile('modal-file')) {
  return back()->withErrors('El archivo es demasiado grande o no se ha subido correctamente.');
} */

  $file = $request->file('modal-file'); // Usamos $request->file() para obtener el archivo
  $name = $request->input('modal-name');
/* return $request->input('modal-id'); */
  $id=$request->input('modal-id');
  $category = MenuCategoryItem::findOrFail($id);

// Verificamos si el archivo es nulo y si el nombre está vacío
if ($file === null && trim($name) !== '') {
    // Solo se modifica el nombre en la base de datos
    $category->name = $request->input('modal-name');
    $category->save();
    return redirect()->back()->with('success', 'Categoría actualizada.');

    //return back()->with('success', 'Nombre de la categoría actualizado correctamente!');
} elseif ($file !== null && trim($name) === '') {
    // Solo se modifica la foto
    $extension=$request->file('modal-file')->getClientOriginalExtension();
    $filename=$category->letter.'.'.$extension;
    $letter=basename($category->letter);
    $end=basename($extension);
    $filename= $letter.'.'.$end ;
    $path = public_path('images/restaurant/menu/'.$letter.'/'. $filename);
      if (file_exists($path)) {
        unlink($path); // Borra la imagen anterior antes de subir la nueva
    }
    $request->file('modal-file')->move(public_path('images/restaurant/menu/'.$letter.'/'), $filename);
    $category->extension = $request->input('extension');
    $category->save();

    return redirect()->back()->with('success', 'Categoría actualizada.');

    //return back()->with('success', 'Imagen de la categoría actualizada correctamente!');

} elseif ($file !== null && trim($name) !== '') {
    // Se modifica tanto el nombre como la foto
    //modifico el name
    $category->name = $request->input('modal-name');
    $category->save();
    //cambiar foto
    $extension=$request->file('modal-file')->getClientOriginalExtension();
    $letter=basename($category->letter);
    $end=basename($extension);
    $filename= $letter.'.'.$end ;
    $path = public_path('images/restaurant/menu/'.$letter.'/'. $filename);
      if (file_exists($path)) {
        unlink($path); // Borra la imagen anterior antes de subir la nueva
    }
    $request->file('modal-file')->move(public_path('images/restaurant/menu/'.$letter.'/'), $filename);
    $category->extension = $request->input('extension');
    $category->save();
    return redirect()->back()->with('success', 'Categoría actualizada.');



}
    /*al modificar una category cambiando dos cosas el nombre que esta en la base de datos y la imagen */
     // Obtiene la categoría (ejemplo: 'A', 'B', etc.)

    // Si todo está bien, continúa con la lógica aquí...

  } catch (\Illuminate\Validation\ValidationException $e) {
    return back()->withErrors('Ocurrió un problema con la validación.')->withInput();
}
    }



 //  Crear nueva categoría
  static public function createCategory(Request $request) {
  $request->validate([
      'name' => 'required|string|unique:menu_category_item,name',
      'letter' => 'required|string|max:10|unique:menu_category_item,letter',
      'extension' => 'required|integer|exists:soported_extension,id',
      'img' => 'nullable|image|mimes:png,jpg,jpeg|max:5048'
  ]);
    $extensionInput= $request->input('extension');
  if ($request->hasFile('img')) {
  try{

    $category= $request->input('letter');
    // Solo se modifica la foto
    $extension=$request->file('img')->getClientOriginalExtension();
    $filename=$category.'.'.$extension;
    $letter=basename($category);
    $end=basename($extension);
    $filename= $letter.'.'.$end ;
    $path = public_path('images/restaurant/menu/'.$letter.'/'. $filename);
      if (file_exists($path)) {
        unlink($path); // Borra la imagen anterior antes de subir la nueva
    }
    $request->file('img')->move(public_path('images/restaurant/menu/'.$letter.'/'), $filename);
  }catch(Exception $e){
    return back()->withErrors('Ocurrió un problema al guardar la imagen ' . $e->getMessage())->withInput();
  }
  }else{
      $extensionInput=4;
  }

  MenuCategoryItem::create([
      'name' => $request->input('name'),
      'letter' => strtoupper($request->input('letter')),
      'extension'=>$extensionInput
  ]);
  TitleItem::create([
    'title'=> $request->input('title-category'),
    'description'=> $request->input('description'),
    'letter'=> strtoupper($request->input('letter'))
  ]);


  return back()->with('success', 'Categoría creada correctamente!');
}

//  Eliminar categoría
static public function deleteCategory(Request $request) {
  try{
  $letter=$request->input('letter');
  TitleItem::where('letter', $letter)->delete();
  Item::where('letter', $letter)->delete();
  $number=(int)$request->input('id');
  $category = MenuCategoryItem::findOrFail($number);
  $category->delete();
  return back()->with('success', 'Categoría eliminada correctamente!');
}catch(Exception $e) {
  return back()->withErrors('Ocurrió un problema al eliminar el ítem: ' . $e->getMessage())->withInput();
}
}

// Crear un ítem
static public function createItem(Request $request) {
  $request->validate([
      'extension' => 'required|integer|exists:soported_extension,id',
      'price' => 'required|numeric|min:0',
      'title' => 'required|string|max:255',
      'description' => 'nullable|string',
      'letter' => 'required|string|exists:menu_category_item,letter',
      'number' => 'required|integer|min:1|max:99',
      'img' => 'nullable|image|mimes:png,jpg,jpeg|max:5048'
  ]);




  Item::create([
      'extension' => $request->input('extension'),
      'price' => $request->input('price'),
      'title' => $request->input('title'),
      'description' => $request->input('description'),
      'letter' => $request->input('letter'),
      'number' => $request->input('number')
  ]);

if ($request->hasFile('img')) {
  try{
    $extension_img = $request->file('img')->getClientOriginalExtension();
    $category=$request->input('letter');
    $number=$request->input('number');
    $letter=$category;
    $end=$extension_img;
    $filename=$category.$number.'.'.$end;
    $path = public_path('images/restaurant/menu/'.$letter.'/'. $filename);
      if (file_exists($path)) {
        unlink($path); // Borra la imagen anterior antes de subir la nueva

    }
    $request->file('img')->move(public_path('images/restaurant/menu/'.$letter.'/'), $filename);
   }catch(Exception $e){
    return back()->withErrors('Ocurrió un problema al acregar la foto del item el ítem: ' . $e->getMessage())->withInput();
   }

  // ...
}


  return back()->with('success', 'Ítem creado correctamente!');
}

//  Actualizar un ítem
static public function updateItem(Request $request) {
  $request->validate([
      'extension' => 'nullable|integer|exists:soported_extension,id',
      'price' => 'nullable|numeric|min:0',
      'title' => 'nullable|string|max:255',
      'description' => 'nullable|string',
      'letter' => 'nullable|string|exists:menu_category_item,letter',
      'number' => 'nullable|integer|min:1|max:99',
      'id'=>  'required|integer',
      'img' => 'nullable|image|mimes:png,jpg,jpeg|max:5048'

  ]);
  if($request->hasFile('img')){

    $category=$request->input('letter');
    $number=$request->input('number');
    $letter=$category;
    $end= $request->file('img')->getClientOriginalExtension();
    $filename=$letter.$number.'.'.$end;
    $path = public_path('images/restaurant/menu/'.$letter.'/'. $filename);
      if (file_exists($path)) {
        unlink($path); // Borra la imagen anterior antes de subir la nueva

    }
    $request->file('img')->move(public_path('images/restaurant/menu/'.$letter.'/'), $filename);

  }

  $item = Item::findOrFail($request->input('id'));
  $item->update($request->only(['extension', 'price', 'title', 'description', 'letter', 'number']));

  return back()->with('success', 'Ítem actualizado correctamente!');
}

//  Eliminar un ítem
static public function deleteItem(Request $request) {
  $id=$request->input('id');
  $item = Item::findOrFail($id);
  $item->delete();
  return back()->with('success', 'Ítem eliminado correctamente!');
}

static public function getLetterDataList (){
  {
    $letras = MenuCategoryItem::pluck('letter'); // Obtiene todas las letras registradas
    return response()->json($letras);
}
}

}


