<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cooking\CrudMenuController as Menu;
use App\Http\Controllers\cooking\CrudItemController as Item;
use App\Http\Controllers\cooking\AdministratorUser;

Route::redirect('/','/home/cooking');



Route::prefix('home/cooking')->group(function(){

    Route::view('/','cook.home.home')->name('cooking');


    //login
    Route::view('/admin','cook.login.admin')->name('admin');
    Route::post('/login',[AdministratorUser::class, 'loginUser'])->name('cook.login');
    Route::get('/logout',[AdministratorUser::class,'logoutUser'])->name('cook.logout');
    //page
    Route::view('/about','cook.about.about')->name('cook.about');
    Route::view('/awards','cook.awards.awards')->name('cook.awards');
    //category
    Route::get('/menu',[Menu::class,'showMenu'])->name('cooking.menu');
    Route::post('/add-category',[Menu::class,'createCategory'])->name('add.category');
    Route::post('/edit-category',[Menu::class,'updateMenu'])->name('edit.category');
    Route::post('/delete-category',[Menu::class,'deleteCategory'])->name('delete.category');

    Route::get('/get-datalist-category',[Menu::class,'getLetterDataListAsync']);
    //item
    Route::get('/menu/{food}', [Item::class, 'showFood'])
    ->where('food', '^[a-zA-Z]{1,10}$')->name('get.food.selected');
    Route::post('/add-item',[Item::class,'createItem'])->name('add.item');
    Route::post('/edit-item',[Item::class,'updateItem'])->name('edit.item');
    Route::post('/delete-item',[Item::class,'deleteItem'])->name('delete.item');

});

