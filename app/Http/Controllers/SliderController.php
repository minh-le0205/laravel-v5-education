<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SliderController extends Controller
{
  private $pathViewController = "admin.slider.";
  private $controllerName = 'slider';

  public function __construct()
  {
    view()->share('controllerName', $this->controllerName);
  }
  public function index()
  {
    return view($this->pathViewController . "index", [
      "message" => "SliderController - index",
      "id" => ''
    ]);
  }

  public function form($id = null)
  {
    return view($this->pathViewController . 'form', [
      "message" => "SliderController - form",
      "id" => $id
    ]);
  }

  public function delete($id)
  {
    return view($this->pathViewController . 'delete', [
      "message" => "SliderController - delete",
      "id" => $id
    ]);
  }

  public function changeStatus(Request $request)
  {
    $id = $request->id;
    $status = $request->status;

    return view($this->pathViewController . 'changeStatus', [
      "message" => "SliderController - changeStatus",
      "id" => $id,
      "status" => $status,
    ]);
  }
}
