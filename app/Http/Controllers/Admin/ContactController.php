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

    public function hasContacted(Request $request)
    {
        $params["currentHasContacted"] = $request->has_contacted;
        $params["id"] = $request->id;
        $this->model->saveItem($params, ['task' => 'change-has-contacted']);

        $hasContacted = $request->has_contacted == '1' ? '0' : '1';

        $route = route($this->controllerName . '/hasContacted', ['has_contacted' => $hasContacted, 'id' => $request->id]);

        return response()->json([
            'statusObj' => config('zvn.template.has_contacted')[$hasContacted],
            'route' => $route,
        ]);
    }
}
