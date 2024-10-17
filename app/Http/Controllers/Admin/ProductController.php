<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductModel as MainModel;
use App\Models\CategoryProductModel;
use App\Http\Requests\ProductRequest as MainRequest;
use App\Http\Controllers\Admin\AdminController;

class ProductController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = "admin.pages.product.";
        $this->controllerName = 'product';
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

    public function changeCategory(Request $request)
    {
        $params["category_id"] = $request->category_id;
        $params["id"] = $request->id;


        $this->model->saveItem($params, ['task' => 'change-category']);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function formProduct(Request $request)
    {
        $item = null;
        if ($request->id != null) {
            $params['id'] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }

        $categoryModel  = new CategoryProductModel();
        $itemsCategory  = $categoryModel->getListItems(null, ['task' => 'admin-list-items-in-selectbox']);

        return view($this->pathViewController . 'form', [
            'item' => $item,
            'itemsCategory' => $itemsCategory
        ]);
    }
}