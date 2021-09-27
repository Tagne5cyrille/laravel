<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});
Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/a-propos', [\App\Http\Controllers\AproposController::class, 'index'])->name('apropos');
Route::get('todos/undone',[\App\Http\Controllers\TodoController::class, 'undone'])->name('todos.undone');
Route::get('todos/done',[\App\Http\Controllers\TodoController::class, 'done'])->name('todos.done');
// route::get('todos/index',[App\Http\Controllers\TodoController::class, 'index'])->name('todos.index');
Route::put('todos/makedone/{todo}', [\App\Http\Controllers\TodoController::class, 'makedone'])->name('todos.makedone');
Route::put('todos/makeundone/{todo}', [\App\Http\Controllers\TodoController::class, 'makeundone'])->name('todos.makeundone');
Route::get('todos/{todo}/affectedto/{user}', [\App\Http\Controllers\TodoController::class, 'affectedTo'])->name('todos.affectedto');
route::get('/Acceuil', [\App\Http\Controllers\AcceuilController::class, 'Acceuil']);

Route::resource('todos', 'App\Http\Controllers\TodoController');

// Route::resource('todos', [App\Http\Controllers\AproposController::class]);
