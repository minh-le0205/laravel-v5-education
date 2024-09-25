<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;

class AdminController extends Controller
{
    protected $pathViewController = "";
    protected $controllerName = '';
    protected $params = [];
    protected $model;

    public function __construct()
    {
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

        $categoryModel  = new CategoryModel();
        $itemsCategory  = $categoryModel->getListItems(null, ['task' => 'admin-list-items-in-selectbox']);

        return view($this->pathViewController . 'form', [
            'item' => $item,
            'itemsCategory' => $itemsCategory
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

        $status = $request->status == 'active' ? 'inactive' : 'active';
        $route = route($this->controllerName . '/status', ['status' => $status, 'id' => $request->id]);


        return response()->json([
            'statusObj' => config('zvn.template.status')[$status],
            'route' => $route,
        ]);
    }
}