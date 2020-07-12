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
    Route::get('/pertanyaan_komentar/{id}/edit', "PertanyaanCommentController@edit");
    Route::put('/pertanyaan_komentar/{id}', "PertanyaanCommentController@update");
    Route::delete('/pertanyaan_komentar/{id}', "PertanyaanCommentController@destroy");


    Route::post('/jawaban_komentar/{id}', "JawabanCommentController@store");
    Route::get('/jawaban_komentar/{id}/edit', "JawabanCommentController@edit");
    Route::put('/jawaban_komentar/{id}', "JawabanCommentController@update");
    Route::delete('/jawaban_komentar/{id}', "JawabanCommentController@destroy");

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
