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

//REFERENCE
Route::get('/reference', 'ReferenceController@reference');
Route::get('/reference/store_R', 'ReferenceController@store_R');
Route::get('/reference', 'ReferenceController@lihat_R');
Route::post('/reference/autofill_ID', 'ReferenceController@autofill_ID')->name('reference.autofill_ID');
Route::post('/reference/autofill_Line', 'ReferenceController@autofill_Line')->name('reference.autofill_Line');


//NON - REFERENCE
Route::get('/non_reference', 'NonReferenceController@non_reference');
Route::get('/non_reference/store_NR', 'NonReferenceController@store_NR');
Route::get('/non_reference', 'NonReferenceController@lihat_NR');
// Route::get('/non_reference', 'NonReferenceController@generate_CodeNR');

Route::get('/loginSSO', 'LoginController@loginSSO');
Route::get('/callback', 'LoginController@callback');
Route::get('/logout', 'LoginController@logout');
Route::post('/logout', 'LoginController@logout')->name('logout');