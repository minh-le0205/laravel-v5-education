<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
  private $pathViewController = "admin.pages.dashboard.";
  private $controllerName = 'dashboard';

  public function __construct()
  {
    view()->share('controllerName', $this->controllerName);
  }
  public function index()
  {
    return view($this->pathViewController . "index", [
      "message" => "DashboardController - index",
      "id" => ''
    ]);
  }
}