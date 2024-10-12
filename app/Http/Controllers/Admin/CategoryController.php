<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel as MainModel;
use App\Http\Requests\CategoryRequest as MainRequest;
use App\Http\Controllers\Admin\AdminController;


class CategoryController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = "admin.pages.category.";
        $this->controllerName = 'category';
        $this->model = new MainModel();
        $this->params['pagination']['totalItemsPerPage'] = 5;
        parent::__construct();
    }

    public function form(Request $request)
    {
        $item = null;

        if ($request->id != null) {
            $this->params['id'] = $request->id;
            $item = $this->model->getItem($this->params, ['task' => 'get-item']);
        }


        $nodes = $this->model->getListItems($this->params, ['task' => 'admin-list-items-in-selectbox']);


        return view($this->pathViewController . 'form', [
            'item' => $item,
            'nodes' => $nodes
        ]);
    }

    public function isHome(Request $request)
    {
        $params["currentIsHome"] = $request->is_home;
        $params["id"] = $request->id;
        $this->model->saveItem($params, ['task' => 'change-is-home']);

        $isHome = $request->is_home == '1' ? '0' : '1';

        $route = route($this->controllerName . '/isHome', ['is_home' => $isHome, 'id' => $request->id]);

        return response()->json([
            'statusObj' => config('zvn.template.is_home')[$isHome],
            'route' => $route,
        ]);
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

    public function display(Request $request)
    {
        $params["currentDisplay"] = $request->display;
        $params["id"] = $request->id;

        $this->model->saveItem($params, ['task' => 'change-display']);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function move(Request $request)
    {
        $params['type'] = $request->type;
        $params['id'] = $request->id;
        $this->model->move($params);

        return redirect()->route($this->controllerName);
    }
}
