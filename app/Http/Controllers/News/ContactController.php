<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactModel;

class ContactController extends Controller
{
    private $pathViewController = "news.pages.contact.";
    private $controllerName = 'contact';
    private $params = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index()
    {
        view()->share('title', 'Liên hệ');
        return view($this->pathViewController . "index");
    }

    public function save() {}
}