<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\C_item;


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

Route::get('/', 'Item\C_item@index');
    
Route::prefix('item')->group(function () {
    Route::get('/', 'Item\C_item@index');
    Route::post('/add-item', 'Item\C_item@add_item');
    Route::post('/edit-item', 'Item\C_item@edit_item');
    Route::post('/delete-item', 'Item\C_item@delete_item');
    Route::get('/get-item-by-id/{id}', 'Item\C_item@get_item_by_id');
}); // end group
