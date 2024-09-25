<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\CategoryModel;
use App\Models\ArticleModel;
use App\Models\SliderModel;
use App\Models\UserModel;

class DashboardController extends AdminController
{
  public function __construct()
  {
    $this->pathViewController = "admin.pages.dashboard.";
    $this->controllerName = 'dashboard';
    view()->share('controllerName', $this->controllerName);
    parent::__construct();
  }


  public function dashboard()
  {
    $dashboardData = [
      [
        'text' => 'Tổng số danh mục',
        'count' => CategoryModel::count(),
        'link' => route('category'),
        'icon' => 'fa fa-table'
      ],
      [
        'text' => 'Tổng số bài viết',
        'count' => ArticleModel::count(),
        'link' => route('article'),
        'icon' => 'fa fa-newspaper-o'
      ],
      [
        'text' => 'Tổng số người dùng',
        'count' => UserModel::count(),
        'link' => route('user'),
        'icon' => 'fa fa-user'
      ],
      [
        'text' => 'Tổng số slider',
        'count' => SliderModel::count(),
        'link' => route('slider'),
        'icon' => 'fa fa-sliders'
      ]
    ];

    return view($this->pathViewController . "index", [
      'dashboardData' => $dashboardData
    ]);
  }
}
