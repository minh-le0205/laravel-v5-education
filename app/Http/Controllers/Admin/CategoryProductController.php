<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CategoryProductModel as MainModel;
use App\Http\Requests\CategoryProductRequest as MainRequest;
use App\Http\Controllers\Admin\AdminController;

class CategoryProductController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = "admin.pages.category_product.";
        $this->controllerName = 'categoryProduct';
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

    public function move(Request $request)
    {
        $params['type'] = $request->type;
        $params['id'] = $request->id;
        $this->model->move($params);

        return redirect()->route($this->controllerName);
    }
}
