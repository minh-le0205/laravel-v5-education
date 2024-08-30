<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as MainModel;
use App\Http\Requests\SliderRequest as MainRequest;


class SliderController extends Controller
{
    private $pathViewController = "admin.pages.slider.";
    private $controllerName = 'slider';
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

    public function form(Request $request)
    {
        $item = null;
        if ($request->id != null) {
            $params['id'] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }
        return view($this->pathViewController . 'form', [
            'item' => $item
        ]);
    }

    public function delete(Request $request)
    {
        $params["id"] = $request->id;

        $this->model->deleteItem($params, ['task' => 'delete-item']);

        return redirect()->route($this->controllerName)->with('zvn_notify', "Xóa phần tử thành công");
    }

    public function changeStatus(Request $request)
    {
        $params["currentStatus"] = $request->status;
        $params["id"] = $request->id;

        $this->model->saveItem($params, ['task' => 'change-status']);

        return redirect()->route($this->controllerName)->with('zvn_notify', "Cập nhật trạng thái thành công");
    }

    public function save(MainRequest $request)
    {

    }
}