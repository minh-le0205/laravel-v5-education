<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel as MainModel;
use App\Http\Requests\CategoryRequest as MainRequest;


class CategoryController extends Controller
{
    private $pathViewController = "admin.pages.category.";
    private $controllerName = 'category';
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

    public function isHome(Request $request)
    {
        $params["currentIsHome"] = $request->is_home;
        $params["id"] = $request->id;
        $this->model->saveItem($params, ['task' => 'change-is-home']);

        return redirect()->route($this->controllerName)->with('zvn_notify', "Cập nhật trạng thái hiển thị trang chủ thành công");
    }

    public function save(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();

            $task = 'add-item';
            $notify = 'Thêm phần tử thành công.';

            if ($params['id'] != null) {
                $task = 'edit-item';
                $notify = 'Cập nhật phần tử thành công.';
            }
            $this->model->saveItem($params, ['task' => $task]);

            return redirect()->route($this->controllerName)->with('zvn_notify', $notify);
        }
    }
}
