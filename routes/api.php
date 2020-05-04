<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', 'AccessController@login');
Route::middleware('auth:sanctum')->post('logout', 'AccessController@logout');
Route::group(['middleware' => ['role:admin', 'auth:sanctum']], function () {
    Route::get('/user', 'UserController@index');
    Route::resource('departamentos', 'DepartamentoController', [
        'names' => [
            'index' => 'departamentos'
        ]
    ]);
});
