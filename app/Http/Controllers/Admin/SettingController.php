<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingModel as MainModel;
use App\Http\Requests\SettingRequest as MainRequest;

class SettingController extends Controller
{
    private $pathViewController = "admin.pages.setting.";
    private $controllerName = 'setting';
    private $params = [];
    private $model;
    public function __construct()
    {
        $this->model = new MainModel();
        $this->params['pagination']['totalItemsPerPage'] = 5;
        view()->share('controllerName', $this->controllerName);
    }

    public function index()
    {
        return view($this->pathViewController . "index");
    }
}