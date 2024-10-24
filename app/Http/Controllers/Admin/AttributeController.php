<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\AttributeModel as MainModel;
use App\Http\Requests\AttributeRequest as MainRequest;

class AttributeController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = "admin.pages.attribute.";
        $this->controllerName = 'attribute';
        $this->model = new MainModel();
        $this->params['pagination']['totalItemsPerPage'] = 5;
        parent::__construct();
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

    public function changeOrdering(Request $request)
    {
        $params["currentOrdering"] = $request->ordering;
        $params["id"] = $request->id;

        $this->model->saveItem($params, ['task' => 'change-ordering']);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
