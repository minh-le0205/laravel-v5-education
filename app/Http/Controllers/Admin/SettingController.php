<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\SettingModel as MainModel;
use App\Http\Requests\SettingRequest as MainRequest;

class SettingController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = "admin.pages.setting.";
        $this->controllerName = 'setting';
        $this->model = new MainModel();
        $this->params['pagination']['totalItemsPerPage'] = 5;
        parent::__construct();
    }

    public function setting()
    {
        return view($this->pathViewController . "index");
    }
}
