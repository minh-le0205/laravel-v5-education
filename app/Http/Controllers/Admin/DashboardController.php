<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;


class DashboardController extends AdminController
{
  // private $pathViewController = "admin.pages.dashboard.";
  // private $controllerName = 'dashboard';

  public function __construct()
  {
    $this->pathViewController = "admin.pages.dashboard.";
    $this->controllerName = 'dashboard';
    view()->share('controllerName', $this->controllerName);
    parent::__construct();
  }


  public function dashboard()
  {
    return view($this->pathViewController . "index");
  }
}