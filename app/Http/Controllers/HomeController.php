<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel;


class HomeController extends Controller
{
    private $pathViewController = "news.pages.home.";
    private $controllerName = 'home';
    private $params = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }
    public function index(Request $request)
    {
        $sliderModel = new SliderModel();
        $itemsSlider = $sliderModel->getListItems(null, ['task' => 'news-list-items']);
        return view($this->pathViewController . "index", [
            'params' => $this->params,
            'itemsSlider' => $itemsSlider
        ]);
    }
}
