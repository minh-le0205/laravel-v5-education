<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

class GalleryController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = "admin.pages.gallery.";
        $this->controllerName = 'gallery';
        view()->share('controllerName', $this->controllerName);
        parent::__construct();
    }

    public function gallery()
    {
        return view($this->pathViewController . "index");
    }
}