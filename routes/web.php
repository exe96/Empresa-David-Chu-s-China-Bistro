<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ikigai\LogController;
use App\Http\Controllers\ikigai\EmailController;
use App\Http\Controllers\ikigai\DashboardController;
use App\Http\Controllers\ikigai\ClassController;
use App\Http\Controllers\cooking\ClassController as c;
use App\Http\Controllers\ikigai\HomeController;
use App\Http\Controllers\ikigai\NewsController;
use App\Http\Controllers\cooking\AdministratorUser;
Route::redirect('/','/home/cooking');



Route::prefix('home/cooking')->group(function(){

    Route::view('/','cooking.home')->name('cooking');
    Route::get('/menu',[c::class,'getMenu'])->name('cooking.menu');
    
    //login
    Route::view('/admin','cooking.views.admin')->name('admin');
    Route::post('/login',[AdministratorUser::class, 'loginUser'])->name('cook.login');
    Route::get('/logout',[AdministratorUser::class,'logoutUser'])->name('cook.logout');
    //page
    Route::view('/about','cooking.views.about')->name('cook.about');
    Route::view('/awards','cooking.views.awards')->name('cook.awards');
    //category
    Route::post('/edit-category',[c::class,'modifyCategory'])->name('edit.category');
    Route::post('/delete-category',[c::class,'deleteCategory'])->name('delete.category');
    Route::post('/add-category',[c::class,'createCategory'])->name('add.category');
    Route::get('/get-datalist-category',[c::class,'getLetterDataList']);
    //item
    Route::get('/menu/{food}', [c::class, 'getFood'])
    ->where('food', '^[a-zA-Z]{1,10}$')->name('get.food.selected');
    Route::post('/add-item',[c::class,'createItem'])->name('add.item');
    Route::post('/edit-item',[c::class,'updateItem'])->name('edit.item');
    Route::post('/delete-item',[c::class,'deleteItem'])->name('delete.item');
    
});

