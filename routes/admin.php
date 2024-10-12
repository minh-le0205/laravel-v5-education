<?php

$prefixAdmin = config("zvn.url.prefix_admin");
// Admin
Route::group(['prefix' => $prefixAdmin, 'namespace' => 'Admin', 'middleware' => ['permission.admin']], function () {

  // Dashboard Group
  $prefix = 'dashboard';
  $controllerName = 'dashboard';
  Route::group(['prefix' => $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName) . 'Controller@';
    Route::get('/', [
      'as' => $controllerName,
      'uses' => $controller . 'dashboard'
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

    Route::get('/move-{type}/{id}', [
      'as' => $controllerName . '/move',
      'uses' => $controller . 'move'
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

    Route::post('change-password', ['as' => $controllerName . '/change-password', 'uses' => $controller . 'changePassword']);
    Route::post('change-level', ['as' => $controllerName . '/change-level', 'uses' => $controller . 'changeLevel']);
  });

  // Rss Group
  $prefix = 'rss';
  $controllerName = 'rss';
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

  // Menu Group
  $prefix = 'menu';
  $controllerName = 'menu';
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

    Route::get('/change-type-menu-{type_menu}/{id}', [
      'as' => $controllerName . '/type_menu',
      'uses' => $controller . 'changeTypeMenu'
    ])->where('id', '[0-9]+');

    Route::get('/change-type-link-{type_link}/{id}', [
      'as' => $controllerName . '/type_link',
      'uses' => $controller . 'changeTypeLink'
    ])->where('id', '[0-9]+');

    Route::get('/change-ordering-{ordering}/{id}', [
      'as' => $controllerName . '/ordering',
      'uses' => $controller . 'changeOrdering'
    ])->where('id', '[0-9]+');
  });

  // Gallery Group
  $prefix = 'gallery';
  $controllerName = 'gallery';
  Route::group(['prefix' => $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName) . 'Controller@';
    Route::get('/', [
      'as' => 'admin/' . $controllerName,
      'uses' => $controller . 'gallery'
    ]);
  });

  // Setting Group
  $prefix = 'setting';
  $controllerName = 'setting';
  Route::group(['prefix' => $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName) . 'Controller@';
    Route::get('/', [
      'as' => $controllerName,
      'uses' => $controller . 'index'
    ]);

    Route::post('/general-setting', [
      'as' => $controllerName . '/general-setting',
      'uses' => $controller . 'general'
    ]);

    Route::post('/social-setting', [
      'as' => $controllerName . '/social-setting',
      'uses' => $controller . 'social'
    ]);

    Route::post('/email-account-setting', [
      'as' => $controllerName . '/email-account-setting',
      'uses' => $controller . 'emailAccount'
    ]);

    Route::post('/email-bcc-setting', [
      'as' => $controllerName . '/email-bcc-setting',
      'uses' => $controller . 'emailBcc'
    ]);
  });

  // Contact Group
  $prefix = 'contact';
  $controllerName = 'contact';
  Route::group(['prefix' => $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName) . 'Controller@';
    Route::get('/', [
      'as' => 'admin/' . $controllerName,
      'uses' => $controller . 'index'
    ]);

    Route::get('/hasContacted/{id}', [
      'as' => $controllerName . '/hasContacted',
      'uses' => $controller . 'hasContacted'
    ])->where('id', '[0-9]+');
  });

  // Logs group
  $prefix = 'logs';
  Route::group(['prefix' => $prefix], function () {
    Route::get('/', function () {
      return view('admin.pages.logs.index');
    })->name('logs');
  });
});
