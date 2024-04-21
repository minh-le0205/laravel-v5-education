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

    // Slider Group
    $prefix = 'slider';
    Route::group(['prefix' => $prefix], function () use ($prefix) {
        $controller = ucfirst($prefix) . 'Controller@';
        Route::get('/', $controller . 'index');
        Route::get('/edit/{id}', $controller . 'form')->where('id', '[0-9]+');
        Route::get('/delete/{id}', $controller . 'delete')->where('id', '[0-9]+');
        Route::get('/change-status-{status}/{id}', $controller . 'changeStatus')->where('id', '[0-9]+');
    });
});