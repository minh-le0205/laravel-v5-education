<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthLoginRequest as MainRequest;
use App\Models\UserModel;

class AuthController extends Controller
{
  private $pathViewController = 'news.pages.auth.';  // slider
  private $controllerName     = 'auth';
  private $params             = [];
  private $model;

  public function __construct()
  {
    view()->share('controllerName', $this->controllerName);
  }

  public function login(Request $request)
  {
    if (strpos(url()->previous(), $request->url()) === false) {
      session(['url.intented' => url()->previous()]);
    }
    return view($this->pathViewController . 'login');
  }

  public function postLogin(MainRequest $request)
  {
    if ($request->method() == 'POST') {
      $params = $request->all();
      $userModel = new UserModel();
      $userInfo = $userModel->getItem($params, ['task' => 'auth-login']);
      if (empty($userInfo)) {
        return redirect()->route($this->controllerName . '/login')->with('news_notify', 'Tài khoản hoặc mật khẩu không chính xác!');
      } else {
        $request->session()->put('userInfo', $userInfo);
        $previousUrl = session()->pull('url.intented');
        return redirect()->away($previousUrl);
      }
    }
  }

  public function logout(Request $request)
  {
    if ($request->session()->has('userInfo')) {
      $request->session()->pull('userInfo');
    }
    return redirect()->route('home');
  }
}
