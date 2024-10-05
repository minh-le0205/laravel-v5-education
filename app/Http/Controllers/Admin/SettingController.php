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

    public function index(Request $request)
    {
        $params['type'] = $request->input('type', 'general');
        $item = $this->model->getItem($params, null);
        if (!empty($item)) {
            $item = json_decode($item['value'], true);
        }
        return view($this->pathViewController . "index", compact('item'));
    }

    public function general(Request $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $this->model->saveItem($params, ['task' => 'setting-general']);
            return redirect()->route($this->controllerName, ['type' => 'general'])->with('zvn_notify', 'Xóa phần tử thành công!');
        }
    }
}
