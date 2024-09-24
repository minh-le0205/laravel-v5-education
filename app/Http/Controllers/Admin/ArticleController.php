<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ArticleModel as MainModel;
use App\Http\Requests\ArticleRequest as MainRequest;
use App\Http\Controllers\Admin\AdminController;


class ArticleController extends AdminController
{

    public function __construct()
    {
        $this->pathViewController = "admin.pages.article.";
        $this->controllerName = 'article';
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

    public function type(Request $request)
    {
        $params["currentType"] = $request->type;
        $params["id"] = $request->id;

        $this->model->saveItem($params, ['task' => 'change-type']);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
