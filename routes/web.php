<?php

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

$prefixAdmin = config("zvn.url.admin");

Route::group(['prefix' => $prefixAdmin], function () {

    // Dashboard Group
    $prefix = 'dashboard';
    Route::group(['prefix' => $prefix], function () use ($prefix) {
        $controller = ucfirst($prefix) . 'Controller@';
        Route::get('/', [
            'as' => $prefix,
            'uses' => $controller . 'index'
        ]);
    });

    // Slider Group
    $prefix = 'slider';
    Route::group(['prefix' => $prefix], function () use ($prefix) {
        $controller = ucfirst($prefix) . 'Controller@';
        Route::get('/', [
            'as' => $prefix,
            'uses' => $controller . 'index'
        ]);
        Route::get('/form/{id}', [
            'as' => $prefix . '/form',
            'uses' => $controller . 'form'
        ])->where('id', '[0-9]+');

        Route::get('/delete/{id}', [
            'as' => $prefix . '/delete',
            'uses' => $controller . 'delete'
        ])->where('id', '[0-9]+');

        Route::get('/change-status-{status}/{id}', [
            'as' => $prefix . '/change-status',
            'uses' => $controller . 'changeStatus'
        ])->where('id', '[0-9]+');
    });
});
