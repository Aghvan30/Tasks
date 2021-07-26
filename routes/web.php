<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

    Route::group(['prefix'=>'admin','middleware'=>['isAdmin','auth']],function (){
   Route::get('dashboard',[\App\Http\Controllers\AdminController::class,'index'])->name('admin.dashboard');
   Route::post('/update-task-status',[\App\Http\Controllers\TaskController::class,'updateSectionStatus']);
   Route::delete('delete-task/{id}',[\App\Http\Controllers\TaskController::class,'deleteTask']);

});

Route::group(['prefix'=>'user','middleware'=>['isUser','auth']],function (){
    Route::get('dashboard',[\App\Http\Controllers\UserController::class,'index'])->name('user.dashboard');
    Route::post('/add-task',[\App\Http\Controllers\TaskController::class,'addTask']);



});

