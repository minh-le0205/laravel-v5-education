<?php

namespace App\Http\Controllers\News;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\ArticleModel;


class ArticleController extends Controller
{
    private $pathViewController = "news.pages.article.";
    private $controllerName = 'article';
    private $params = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }
    public function index(Request $request)
    {
        $params['article_id'] = $request->article_id;
        $articleModel = new ArticleModel();
        $categoryModel = new CategoryModel();


        $itemArticle = $articleModel->getItem($params, ['task' => 'news-get-items']);
        if (empty($itemArticle)) {
            return redirect()->route('home');
        }



        $itemsLatest = $articleModel->getListItems(null, ['task' => 'news-list-items-latest']);

        $params['category_id'] = $itemArticle['category_id'];
        $itemArticle['related_articles'] = $articleModel->getListItems($params, ['task' => 'news-list-items-related-in-category']);

        $breadcrumbs = $categoryModel->getListItems($params, ['task' => 'news-breadcrumbs']);


        return view($this->pathViewController . "index", [
            'params' => $this->params,
            'itemsLatest' => $itemsLatest,
            'itemArticle' => $itemArticle,
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
