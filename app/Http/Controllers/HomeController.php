<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel;
use App\Models\CategoryModel;
use App\Models\ArticleModel;


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

        $categoryModel = new CategoryModel();
        $itemsCategory = $categoryModel->getListItems(null, ['task' => 'news-list-items-is-home']);

        $articleModel = new ArticleModel();
        $itemsFeatured = $articleModel->getListItems(null, ['task' => 'news-list-items-feature']);
        $itemsLatest = $articleModel->getListItems(null, ['task' => 'news-list-items-latest']);
        return view($this->pathViewController . "index", [
            'params' => $this->params,
            'itemsSlider' => $itemsSlider,
            'itemsCategory' => $itemsCategory,
            'itemsFeatured' => $itemsFeatured,
            'itemsLatest' => $itemsLatest
        ]);
    }
}
