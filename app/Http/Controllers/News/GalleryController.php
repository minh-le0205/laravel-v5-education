<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use File;

class GalleryController extends Controller
{
    private $pathViewController = "news.pages.gallery.";
    private $controllerName = 'gallery';
    private $params = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index()
    {
        view()->share('title', 'Thư viện hình ảnh');
        $directory = config('zvn.path.gallery');
        $path = public_path($directory);
        $items = File::files($path);
        return view($this->pathViewController . "index", compact('items'));
    }
}