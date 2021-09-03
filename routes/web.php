<?php

use App\Http\Livewire\Admin\Categories;
use App\Http\Livewire\Admin\Category;
use App\Http\Livewire\Admin\Homepage;
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

Route::get('/', function(){
    return view('index');
});

Route::group(['prefix'=>'admin'], function(){
    Route::get('/', Homepage::class)->name('admin');

    Route::group(['prefix'=>'category'], function(){
        Route::get('/categories', Categories::class)->name('categories');
        Route::get('/', Category::class)->name('category');
    });
});