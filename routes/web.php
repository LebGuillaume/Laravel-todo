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
    return view('welcome');
});
Route::get('/a-propos','AproposController@index')->name('apropos');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

route::get('todo/undone', 'TodoController@undone')->name('todos.undone');
route::get('todo/done', 'TodoController@done')->name('todos.done');
route::put('todos/makedone/{todo}', 'TodoController@makedone')->name('todos.makedone');
route::put('todos/makeundone/{todo}', 'TodoController@makeundone')->name('todos.makeundone');
route::get('todos/{todo}/affectedTo/{user}','TodoController@affectedto')->name('todos.affectedto');
Route::resource('todos', 'TodoController');


