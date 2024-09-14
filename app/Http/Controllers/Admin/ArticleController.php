<?php

namespace App\Http\Controllers\Admin;

use App\Models\CategoryModel;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleModel as MainModel;
use App\Http\Requests\ArticleRequest as MainRequest;


class ArticleController extends Controller
{
    private $pathViewController = "admin.pages.article.";
    private $controllerName = 'article';
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

        $categoryModel = new CategoryModel();
        $itemsCategory = $categoryModel->getListItems(null, ['task' => 'admin-list-items-in-selectbox']);
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

        return redirect()->route($this->controllerName)->with('zvn_notify', "Cập nhật trạng thái thành công");
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

        return redirect()->route($this->controllerName)->with('zvn_notify', "Cập nhật kiểu bài viết thành công");
    }
}