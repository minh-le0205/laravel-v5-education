<?php

$prefixNews = config("zvn.url.prefix_news");

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

    Route::get('/not-found', [
      'as' => $controllerName . "/notFound",
      'uses' => $controller . 'notFound'
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

  // ============================== NOTIFY ==============================
  $prefix = '';
  $controllerName = 'notify';
  Route::group(['prefix' => $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName) . 'Controller@';
    Route::get('/no-permission', ['as' => $controllerName . '/noPermission', 'uses' => $controller . 'noPermission']);
  });

  // Login
  $prefix = '';
  $controllerName = 'auth';

  Route::group(['prefix' => $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName) . 'Controller@';
    Route::get('/login', ['as' => $controllerName . '/login', 'uses' => $controller . 'login'])->middleware('check.login');
    Route::post('/postLogin', ['as' => $controllerName . '/postLogin', 'uses' => $controller . 'postLogin']);

    // ====================== LOGOUT ========================
    Route::get('/logout', ['as' => $controllerName . '/logout', 'uses' => $controller . 'logout']);
  });

  // ====================== RSS ========================
  $prefix = '';
  $controllerName = 'rss';
  Route::group(['prefix' => $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName) . 'Controller@';
    Route::get('/tin-tuc-tong-hop', ['as' => "$controllerName/index", 'uses' => $controller . 'index']);
    Route::get('/get-gold', ['as' => "$controllerName/get-gold", 'uses' => $controller . 'getGold']);
    Route::get('/get-coin', ['as' => "$controllerName/get-coin", 'uses' => $controller . 'getCoin']);
  });

  // Gallery
  $prefix = 'thu-vien-hinh-anh';
  $controllerName = 'gallery';
  Route::group(['prefix' => $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName) . 'Controller@';
    Route::get('/', [
      'as' => $controllerName,
      'uses' => $controller . 'index'
    ]);
  });
});
