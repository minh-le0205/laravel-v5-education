<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as MainModel;


class SliderController extends Controller
{
    private $pathViewController = "admin.pages.slider.";
    private $controllerName = 'slider';
    private $params = [];
    private $model;

    public function __construct()
    {
        $this->model = new MainModel();
        $this->params['pagination']['totalItemsPerPage'] = 1;
        view()->share('controllerName', $this->controllerName);
    }
    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $this->params['search']['field'] = $request->input('search_field', '');
        $this->params['search']['value'] = $request->input('search_value', '');
        $items = $this->model->getListItems($this->params, ['task' => 'admin-list-item']);
        $countListStatus = $this->model->countListItems($this->params, ['task' => 'admin-list-item']);
        return view($this->pathViewController . "index", [
            'params' => $this->params,
            "items" => $items,
            "countListStatus" => $countListStatus,
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