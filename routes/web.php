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
Route::get('/{vue_capture?}',function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');


// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', function () {
//     $img = Image::make('https://mirekoc.ku.edu.tr/wp-content/uploads/2014/08/images4.jpg')->resize(300, 200);

//     return $img->response('jpg');
// });


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
