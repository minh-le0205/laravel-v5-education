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

$prefixAdmin = config("zvn.url.prefix_admin");
$prefixNews = config("zvn.url.prefix_news");

// Admin
Route::group(['prefix' => $prefixAdmin], function () {

    // Dashboard Group
    $prefix = 'dashboard';
    $controllerName = 'dashboard';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/', [
            'as' => $controllerName,
            'uses' => $controller . 'index'
        ]);
    });

    // Category Group
    $prefix = 'category';
    $controllerName = 'category';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/', [
            'as' => $controllerName,
            'uses' => $controller . 'index'
        ]);
        Route::get('/form/{id?}', [
            'as' => $controllerName . '/form',
            'uses' => $controller . 'form'
        ])->where('id', '[0-9]+');

        Route::post('/save', [
            'as' => $controllerName . '/save',
            'uses' => $controller . 'save'
        ]);

        Route::get('/delete/{id}', [
            'as' => $controllerName . '/delete',
            'uses' => $controller . 'delete'
        ])->where('id', '[0-9]+');

        Route::get('/change-status-{status}/{id}', [
            'as' => $controllerName . '/status',
            'uses' => $controller . 'changeStatus'
        ])->where('id', '[0-9]+');

        Route::get('/isHome/{id}', [
            'as' => $controllerName . '/isHome',
            'uses' => $controller . 'isHome'
        ])->where('id', '[0-9]+');
    });

    // Slider Group
    $prefix = 'slider';
    $controllerName = 'slider';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/', [
            'as' => $controllerName,
            'uses' => $controller . 'index'
        ]);
        Route::get('/form/{id?}', [
            'as' => $controllerName . '/form',
            'uses' => $controller . 'form'
        ])->where('id', '[0-9]+');

        Route::post('/save', [
            'as' => $controllerName . '/save',
            'uses' => $controller . 'save'
        ]);

        Route::get('/delete/{id}', [
            'as' => $controllerName . '/delete',
            'uses' => $controller . 'delete'
        ])->where('id', '[0-9]+');

        Route::get('/change-status-{status}/{id}', [
            'as' => $controllerName . '/status',
            'uses' => $controller . 'changeStatus'
        ])->where('id', '[0-9]+');
    });
});

// News
Route::group(['prefix' => $prefixNews], function () {
    // Homepage
    $prefix = '';
    $controllerName = 'home';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/', [
            'as' => $controllerName,
            'uses' => $controller . 'index'
        ]);
    });

});
