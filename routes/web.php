<?php

use App\Http\Controllers\PersonController;
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
    return redirect(\route('person.create'));
});

Route::get('person/list', [PersonController::class, 'view'])->name('person.list');
Route::get('person/create', [PersonController::class, 'create'])->name('person.create');
Route::get('person/edit/{id}', [PersonController::class, 'edit'])->name('person.edit');
Route::post('person/post_operation', [PersonController::class, 'post_operation'])->name('person.post_operation');
Route::get('person/delete/{id}', [PersonController::class, 'delete'])->name('person.delete');


