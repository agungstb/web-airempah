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
    return redirect('/search');
});

Route::get('/search', 'SearchController@index')->name('search');
Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('admin.home');

    Route::get('/integrity','IntegrityController@index')->name('admin.integrity.index');
    Route::get('/integrity/data','IntegrityController@data')->name('admin.integrity.data');
    Route::get('/integrity/create','IntegrityController@create')->name('admin.integrity.create');
    Route::post('/integrity','IntegrityController@store')->name('admin.integrity.store');
    Route::get('/integrity/{id}/edit','IntegrityController@edit')->name('admin.integrity.edit');
    Route::patch('/integrity/{id}','IntegrityController@update')->name('admin.integrity.update');
    Route::delete('/integrity/{id}','IntegrityController@destroy')->name('admin.integrity.delete');

    Route::get('/criteria','CriteriaController@index')->name('admin.criteria.index');
    Route::get('/criteria/data','CriteriaController@data')->name('admin.criteria.data');
    Route::get('/criteria/create','CriteriaController@create')->name('admin.criteria.create');
    Route::post('/criteria','CriteriaController@store')->name('admin.criteria.store');
    Route::get('/criteria/{id}/edit','CriteriaController@edit')->name('admin.criteria.edit');
    Route::patch('/criteria/{id}','CriteriaController@update')->name('admin.criteria.update');
    Route::delete('/criteria/{id}','CriteriaController@destroy')->name('admin.criteria.delete');

    Route::get('/herb','HerbController@index')->name('admin.herb.index');
    Route::get('/herb/data','HerbController@data')->name('admin.herb.data');
    Route::get('/herb/create','HerbController@create')->name('admin.herb.create');
    Route::post('/herb','HerbController@store')->name('admin.herb.store');
    Route::get('/herb/{id}/edit','HerbController@edit')->name('admin.herb.edit');
    Route::patch('/herb/{id}','HerbController@update')->name('admin.herb.update');
    Route::delete('/herb/{id}','HerbController@destroy')->name('admin.herb.delete');

    Route::get('/fuzzification','FuzzificationController@index')->name('admin.fuzzification.index');
    Route::get('/fuzzification/data','FuzzificationController@data')->name('admin.fuzzification.data');

    Route::get('/zadeh','ZadehController@index')->name('admin.zadeh.index');
    Route::get('/zadeh/data','ZadehController@data')->name('admin.zadeh.data');

    Route::get('/select/integrity','SelectController@integrity')->name('admin.select.integrity');
    Route::get('/select/disease','SelectController@disease')->name('admin.select.disease');
    Route::get('/select/nutrient','SelectController@nutrient')->name('admin.select.nutrient');
});
