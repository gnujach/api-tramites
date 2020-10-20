<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', 'AccessController@login');
Route::middleware('auth:sanctum')->post('logout', 'AccessController@logout');
Route::group(['middleware' => ['role:admin', 'auth:sanctum']], function () {
    Route::get('/user', 'UserController@index');
    Route::resource('users', 'UserController', [
        'names' => [
            'index' => 'users'
        ]
    ]);
    Route::resource('departamentos', 'DepartamentoController', [
        'names' => [
            'index' => 'departamentos'
        ]
    ]);
    Route::post('/user-images', 'UserImageController@store');
});
Route::middleware('auth:sanctum')->post('/auth/loginwithms', 'AccessController@loginwithms');
