<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel as MainModel;
use App\Http\Requests\UserRequest    as MainRequest;


class UserController extends Controller
{
    private $pathViewController = "admin.pages.user.";
    private $controllerName = 'user';
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
        $items = $this->model->getListItems($this->params, ['task' => 'admin-list-items']);
        $countListStatus = $this->model->countListItems($this->params, ['task' => 'admin-count-items-group-by-status']);


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

        $status = $request->status == 'active' ? 'inactive' : 'active';
        $route = route($this->controllerName . '/status', ['status' => $status, 'id' => $request->id]);

        return response()->json([
            'statusObj' => config('zvn.template.status')[$status],
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

    public function level(Request $request)
    {
        $params["currentLevel"]   = $request->level;
        $params["id"]               = $request->id;
        $this->model->saveItem($params, ['task' => 'change-level']);
        return redirect()->route($this->controllerName)->with("zvn_notify", "Cập nhật kiểu hiện thị thành công!");
    }

    public function changePassword(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $this->model->saveItem($params, ['task' => 'change-password']);
            return redirect()->route($this->controllerName)->with("zvn_notify", "Thay đổi mật khẩu thành công!");
        }
    }

    public function changeLevel(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $this->model->saveItem($params, ['task' => 'change-level-post']);
            return redirect()->route($this->controllerName)->with("zvn_notify", "Thay đổi level thành công!");
        }
    }
}
