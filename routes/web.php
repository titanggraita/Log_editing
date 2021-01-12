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

//LARAVEL
Route::get('/', function () {
    return view('welcome');
});

//REFERENCE
Route::get('/reference', 'ReferenceController@reference');
Route::get('/reference/store_R', 'ReferenceController@store_R');
Route::post('/reference/fetch', 'ReferenceController@fetch')->name('reference.fetch');

//NON - REFERENCE
Route::get('/non_reference', 'NonReferenceController@non_reference');
Route::get('/non_reference/store_NR', 'NonReferenceController@store_NR');

//LOGIN SSO
Route::get('/loginSSO', 'LoginController@loginSSO');
Route::get('/callback', 'LoginController@callback');
Route::get('/logout', 'LoginController@logout');
Route::post('/logout', 'LoginController@logout')->name('logout');