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
    // return view('welcome');
    return redirect("/pertanyaan");
});

Auth::routes();

Route::group(["middleware" => ["auth"]], function(){
    Route::resource('/pertanyaan',  'PertanyaanController')->except([
        "index", "show"
    ]);
    Route::resource('/pertanyaan/{id}/jawaban','JawabanController')->only([
        "store", "edit", "update", "destroy", "index"
    ]);
});

Route::resource('/pertanyaan',  'PertanyaanController')->only([
    'index', 'show'
]);

// Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/users',       'UserController');

Route::resource('/tag',         'TagController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
