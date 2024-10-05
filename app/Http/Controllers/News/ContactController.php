<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactModel;
use App\Mail\MailService;

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

    public function postContact(Request $request)
    {
        view()->share('title', 'Liên hệ');
        if ($request->method() == 'POST') {
            $data = $request->all();

            $mailService = new MailService;
            $mailService->sendMailConfirm($data);
            $mailService->sendMailInfo($data);

            $contactModel = new ContactModel();
            $contactModel->saveItem($data, ['task' => 'add-item']);

            return redirect()->route($this->controllerName)->with('zvn_notify', 'Cảm ơn bạn đã gửi thông tin. Chúng tôi sẽ liên hệ trong thời gian sớm nhát');
        }
    }
}