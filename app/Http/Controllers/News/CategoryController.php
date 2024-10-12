<?php

namespace App\Http\Controllers\News;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\ArticleModel;


class CategoryController extends Controller
{
    private $pathViewController = "news.pages.category.";
    private $controllerName = 'category';
    private $params = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }
    public function index(Request $request)
    {
        $params['category_id'] = $request->category_id;
        $articleModel = new ArticleModel();
        $categoryModel = new CategoryModel();


        $itemCategory = $categoryModel->getItem($params, ['task' => 'news-get-items']);
        if (empty($itemCategory)) {
            return redirect()->route('home');
        }


        $paramsV['category_id'] = $itemCategory['id'];
        $itemCategory['articles'] = $articleModel->getListItems($paramsV, ['task' => 'news-list-items-category']);

        $itemsLatest = $articleModel->getListItems(null, ['task' => 'news-list-items-latest']);

        $breadcrumbs = $categoryModel->getListItems($params, ['task' => 'news-breadcrumbs']);


        return view($this->pathViewController . "index", [
            'params' => $this->params,
            'itemsLatest' => $itemsLatest,
            'itemCategory' => $itemCategory,
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
