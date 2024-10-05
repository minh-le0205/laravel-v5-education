<?php

namespace App\Http\Controllers\News;

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
        $categoryModel = new CategoryModel();
        $articleModel = new ArticleModel();


        $itemsSlider = $sliderModel->getListItems(null, ['task' => 'news-list-items']);
        $itemsCategory = $categoryModel->getListItems(null, ['task' => 'news-list-items-is-home']);
        $itemsFeatured = $articleModel->getListItems(null, ['task' => 'news-list-items-feature']);
        $itemsLatest = $articleModel->getListItems(null, ['task' => 'news-list-items-latest']);

        foreach ($itemsCategory as $key => $item) {
            $params['category_id'] = $item['id'];
            $itemsCategory[$key]['articles'] = $articleModel->getListItems($params, ['task' => 'news-list-items-category']);
        }
        return view($this->pathViewController . "index", [
            'params' => $this->params,
            'itemsSlider' => $itemsSlider,
            'itemsCategory' => $itemsCategory,
            'itemsFeatured' => $itemsFeatured,
            'itemsLatest' => $itemsLatest
        ]);
    }

    public function notFound()
    {
        return view($this->pathViewController . "not_found");
    }
}
