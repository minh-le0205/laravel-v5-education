<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\ContactModel as MainModel;
use App\Http\Requests\ContactRequest as MainRequest;

class ContactController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = "admin.pages.contact.";
        $this->controllerName = 'contact';
        $this->model = new MainModel();
        $this->params['pagination']['totalItemsPerPage'] = 5;
        parent::__construct();
    }

    public function hasContacted(Request $request) {}
}