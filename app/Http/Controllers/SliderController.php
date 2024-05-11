<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as MainModel;


class SliderController extends Controller
{
    private $pathViewController = "admin.pages.slider.";
    private $controllerName = 'slider';
    private $model;

    public function __construct()
    {
        $this->model = new MainModel();
        view()->share('controllerName', $this->controllerName);
    }
    public function index()
    {
        $items = $this->model->getListItems(null, ['task' => 'admin-list-item']);
        return view($this->pathViewController . "index", [
            "items" => $items
        ]);
    }

    public function form($id = null)
    {
        return view($this->pathViewController . 'form', [
            "message" => "SliderController - form",
            "id" => $id
        ]);
    }

    public function delete($id)
    {
        return view($this->pathViewController . 'delete', [
            "message" => "SliderController - delete",
            "id" => $id
        ]);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        return view($this->pathViewController . 'changeStatus', [
            "message" => "SliderController - changeStatus",
            "id" => $id,
            "status" => $status,
        ]);
    }
}
