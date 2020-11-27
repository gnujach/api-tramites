<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', 'AccessController@login');
Route::middleware('auth:sanctum')->post('logout', 'AccessController@logout');
Route::group(['middleware' => ['role:admin', 'auth:sanctum']], function () {
    Route::get('/user', 'UserController@index');
    Route::resource('users', 'UserController', [
        'names' => [
            'index' => 'users'
        ]
    ]);
    Route::get('/getdepartamentos', 'DepartamentoController@getdepartamentos');
    Route::get('/getrequisitos', 'RequisitoController@getrequisitos');
    Route::get('/gettipousuarios', 'TipousuarioController@gettipousuarios');
    Route::post('/tramites/addreqtotramite/{id}', 'TramiteController@addreqtotramite');
    Route::resource('departamentos', 'DepartamentoController', [
        'names' => [
            'index' => 'departamentos'
        ]
    ]);
    Route::resource('requisitos', 'RequisitoController');
    Route::resource('tramites', 'TramiteController', [
        'names' => [
            'index' => 'tramites'
        ]
    ]);
    Route::post('/user-images', 'UserImageController@store');
});
Route::middleware('auth:sanctum')->post('/auth/loginwithms', 'AccessController@loginwithms');
