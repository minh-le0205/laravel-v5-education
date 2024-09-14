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


        $itemArticle = $articleModel->getItem($params, ['task' => 'news-get-items']);
        if (empty($itemArticle)) {
            return redirect()->route('home');
        }



        $itemsLatest = $articleModel->getListItems(null, ['task' => 'news-list-items-latest']);


        return view($this->pathViewController . "index", [
            'params' => $this->params,
            'itemsLatest' => $itemsLatest,
            'itemArticle' => $itemArticle
        ]);
    }
}