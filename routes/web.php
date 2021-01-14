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
// Route::get('/', function () {
//     return view('reference');
// });

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', 'ReferenceController@reference');
});
//REFERENCE

Route::get('/reference/store_R', 'ReferenceController@store_R');
Route::post('/reference/fetch', 'ReferenceController@fetch')->name('reference.fetch');
Route::post('/reference/autofill', 'ReferenceController@autofill')->name('reference.autofill');

//NON - REFERENCE
Route::get('/non_reference', 'NonReferenceController@non_reference');
Route::get('/non_reference/store_NR', 'NonReferenceController@store_NR');
Route::post('/non_reference/fetch_NR', 'NonReferenceController@fetch_NR')->name('non_reference.fetch_NR');
Route::post('/non_reference/autofill_NR', 'NonReferenceController@autofill_NR')->name('non_reference.autofill_NR');

//LOGIN SSO
Route::get('/loginSSO', 'LoginController@loginSSO')->name('login');
Route::get('/callback', 'LoginController@callback');
Route::get('/logout', 'LoginController@logout');
Route::post('/logout', 'LoginController@logout')->name('logout');