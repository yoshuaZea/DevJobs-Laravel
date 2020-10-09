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

// Route::get('/home', 'HomeController@index')->name('home');

// AUTENTICACIÓN
Auth::routes(['verify' => true]);

// VACANTES
Route::group(['middleware' => ['auth', 'verified']], function(){
    // Acciones para la vacante
    Route::get('/vacantes', 'VacanteController@index')->name('vacantes.index');
    Route::get('/vacantes/create', 'VacanteController@create')->name('vacantes.create');
    Route::post('/vacantes', 'VacanteController@store')->name('vacantes.store');
    Route::get('/vacantes/{vacante}/edit', 'VacanteController@edit')->name('vacantes.edit')->where('vacante', '[0-9]+');
    Route::put('/vacantes/{vacante}', 'VacanteController@update')->name('vacantes.update')->where('vacante', '[0-9]+');

    // Cambiar estado de la vacante
    Route::post('/vacantes/{vacante}', 'VacanteController@changeState')->name('vacantes.change')->where('vacante', '[0-9]+');;

    // Eliminar vacante
    Route::delete('/vacantes/{vacante}', 'VacanteController@destroy')->name('vacantes.destroy')->where('vacante', '[0-9]+');;

    // Subir imagenes
    Route::post('/vacantes/imagen', 'VacanteController@upload')->name('vacantes.upload');
    Route::post('/vacantes/borrar-imagen', 'VacanteController@deleteimage')->name('vacantes.deleteimage');

    // Notificaciones
    Route::get('/notificaciones', 'NotificacionesController')->name('notificaciones');

    // Listado de candidatos por vacante
    Route::get('/candidatos', 'CandidatoController@index')->name('candidatos.index');
});

// RUTA VACANTE PÚBLICA SIN AUTENTICACIÓN
Route::get('/vacantes/{vacante}', 'VacanteController@show')->name('vacantes.show')->where('vacante', '[0-9]+');

// BUSCAR VACANTES
Route::post('/vacantes/buscar', 'VacanteController@search')->name('vacantes.search');

// ENVIAR DATOS PARA UNA VACANTE
Route::post('/candidatos/store', 'CandidatoController@store')->name('candidatos.store');

// PAGINA INICIO
Route::get('/', 'InicioController')->name('inicio');

// CATEGORIAS
Route::get('/categorias/{categoria}', 'CategoriaController@show')->name('categorias.show');
