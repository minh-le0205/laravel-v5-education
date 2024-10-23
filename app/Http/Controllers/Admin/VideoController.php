<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SettingModel;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    private $pathViewController = "admin.pages.video.";
    private $controllerName = 'video';
    private $params = [];

    protected $settingModel;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
        $this->settingModel = new SettingModel();
    }

    public function index()
    {
        $item = $this->settingModel->getItem(['type' => 'video'], null);

        return view($this->pathViewController . "index", compact('item'));
    }

    public function save(Request $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->except('_token');
            $this->settingModel->saveItem($params, ['task' => 'setting-video']);
            return redirect()->route($this->controllerName)->with('zvn_notify', 'Cập nhật thông tin video thành công!');
        }
    }
}
