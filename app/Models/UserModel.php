<?php

namespace App\Models;


use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\AdminModel;

class UserModel extends AdminModel
{
    public function __construct()
    {
        $this->table = 'user';
        $this->folderUpload = 'user';
        $this->fieldSearchAccepted = [
            'id',
            'username',
            'email',
            'fullname'
        ];
        $this->crudNotAccepted = [
            '_token',
            'avatar_current',
            'password_confirmation',
            'task'
        ];
    }

    public function getListItems($params, $options)
    {
        $results = null;

        if ($options['task'] == "admin-list-items") {
            $query = self::select('id', 'username', 'email', 'fullname', 'avatar', 'status', 'level', 'created', 'created_by', 'modified', 'modified_by');

            if ($params['filter']['status'] !== "all") {
                $query->where('status', '=', $params['filter']['status']);
            }

            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }


            $results = $query->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }



        return $results;
    }

    public function getItem($params, $options)
    {
        $result = null;

        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'username', 'email', 'status', 'fullname', 'level', 'avatar')->where('id', $params['id'])->first();
        }

        if ($options['task'] == 'get-avatar') {
            $result = self::select('id', 'avatar')->where('id', $params['id'])->first();
        }

        if ($options['task'] == 'auth-login') {
            $result = self::select('id', 'username', 'fullname', 'email', 'level', 'avatar')
                ->where('status', 'active')
                ->where('email', $params['email'])
                ->where('password', md5($params['password']))->first();

            if ($result) $result = $result->toArray();
        }

        return $result;
    }

    public function countListItems($params, $options)
    {
        $result = null;

        if ($options['task'] == 'admin-count-items-group-by-status') {

            $query = $this::groupBy('status')
                ->select(DB::raw('count(*) as user_count,status'));

            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }

            $result = $query->get()->toArray();
        }

        return $result;
    }

    public function saveItem($params, $options)
    {
        if ($options['task'] == 'change-status') {
            $status = ($params['currentStatus'] == "active") ? "inactive" : "active";
            self::where('id', $params['id'])->update(['status' => $status]);
        }

        if ($options['task'] == 'add-item') {
            $params['created_by'] = "hailan";
            $params['created']    = date('Y-m-d');
            $params['avatar']      = $this->uploadThumb($params['avatar']);
            $params['password']    = md5($params['password']);
            self::insert($this->prepareParams($params));
        }

        if ($options['task'] == 'edit-item') {
            if (!empty($params['avatar'])) {
                $this->deleteThumb($params['avatar_current']);
                $params['avatar'] = $this->uploadThumb($params['avatar']);
            }
            $params['modified_by']   = "hailan";
            $params['modified']      = date('Y-m-d');
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }

        if ($options['task'] == 'change-level') {
            $level = $params['currentLevel'];
            self::where('id', $params['id'])->update(['level' => $level]);
        }

        if ($options['task'] == 'change-level-post') {
            $level = $params['level'];
            self::where('id', $params['id'])->update(['level' => $level]);
        }

        if ($options['task'] == 'change-password') {
            $password       = md5($params['password']);
            self::where('id', $params['id'])->update(['password' => $password]);
        }
    }

    public function deleteItem($params, $options)
    {

        if ($options['task'] == 'delete-item') {
            $item   = self::getItem($params, ['task' => 'get-avatar']); // 
            $this->deleteThumb($item['avatar']);
            self::where('id', $params['id'])->delete();
        }
    }
}