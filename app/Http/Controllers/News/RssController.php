<?php

namespace App\Http\Controllers\News;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RssModel;
use App\Helpers\Feed;


class RssController extends Controller
{
    private $pathViewController = 'news.pages.rss.';  // slider
    private $controllerName     = 'rss';
    private $params             = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }
    public function index(Request $request)
    {
        view()->share('title', 'Tin tức tổng hợp');
        $rssModel   = new RssModel();

        $itemsRss   = $rssModel->getListItems(null, ['task'   => 'news-list-items']);
        $data = Feed::read($itemsRss);

        return view($this->pathViewController .  'index', [
            'items'   => $data
        ]);
    }
}
