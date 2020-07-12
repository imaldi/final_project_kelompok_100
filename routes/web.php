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

    Route::post('/pertanyaan/{id}/up', "VotePertanyaanController@up");
    Route::post('/pertanyaan/{id}/down', "VotePertanyaanController@down");
    Route::post('/jawaban/{id}/up', "VoteJawabanController@up");
    Route::post('/jawaban/{id}/down', "VoteJawabanController@down");
    Route::post('/pertanyaan_komentar/{id}', "PertanyaanCommentController@store");
    Route::post('/jawaban_komentar/{id}', "JawabanCommentController@store");

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
