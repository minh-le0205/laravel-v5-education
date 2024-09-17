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
Route::group(['prefix' => $prefixAdmin, 'namespace' => 'Admin'], function () {

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

        Route::get('/change-display-{display}/{id}', [
            'as' => $controllerName . '/display',
            'uses' => $controller . 'display'
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

    // Article Group
    $prefix = 'article';
    $controllerName = 'article';
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

        Route::get('/change-type-{type}/{id}', [
            'as' => $controllerName . '/type',
            'uses' => $controller . 'type'
        ])->where('id', '[0-9]+');
    });

    // User Group
    $prefix = 'user';
    $controllerName = 'user';
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

        Route::get('/change-level-{level}/{id}', [
            'as' => $controllerName . '/level',
            'uses' => $controller . 'level'
        ])->where('id', '[0-9]+');
    });
});

// News
Route::group(['prefix' => $prefixNews, 'namespace' => 'News'], function () {
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

    // Category
    $prefix = 'chuyen-muc';
    $controllerName = 'category';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/{category_name}-{category_id}.html', [
            'as' => $controllerName . '/index',
            'uses' => $controller . 'index'
        ])->where('category_name', '[0-9a-zA-Z_-]+')
            ->where('category_id', '[0-9]+');
    });

    $prefix = 'bai-viet';
    $controllerName = 'article';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/{article_name}-{article_id}.html', [
            'as' => $controllerName . '/index',
            'uses' => $controller . 'index'
        ])->where('article_name', '[0-9a-zA-Z_-]+')
            ->where('article_id', '[0-9]+');
    });
});