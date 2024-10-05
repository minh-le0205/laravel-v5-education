<?php

namespace App\Models;

use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\AdminModel;

class ContactModel extends AdminModel
{
    public function __construct()
    {
        $this->table = 'contact';
        $this->folderUpload = 'contact';
        $this->fieldSearchAccepted = [
            'full_name',
            'email',
            'phone',
            'message',
            'has_contacted',
            'ip_address'
        ];
        $this->crudNotAccepted = [
            '_token'
        ];
    }

    public function getListItems($params, $options)
    {
        $result = null;

        if ($options['task'] == "admin-list-item") {
            $query = $this->select('id', 'full_name', 'email', 'phone', 'message', 'has_contacted', 'ip_address', 'created');

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

            $result =  $query->orderBy('ordering', 'asc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }

        return $result;
    }

    public function getItem($params, $options)
    {
        $result = null;

        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'full_name', 'email', 'phone', 'message', 'has_contacted', 'ip_address', 'created')->where('id', $params['id'])->first();
        }

        return $result;
    }

    public function countListItems($params, $options)
    {
        $result = null;

        if ($options['task'] == 'admin-list-item') {

            $query = $this::groupBy('has_contacted')
                ->select(DB::raw('count(*) as user_count, has_contacted'));

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
        if ($options['task'] == 'add-item') {
            $params['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $params['created'] = date('Y-m-d H:i:s');
            self::insert($this->prepareParams($params));
        }

        if ($options['task'] == 'change-has-contacted') {
            $hasContacted = ($params['currentHasContacted'] == "yes") ? "no" : "yes";
            self::where('id', $params['id'])->update(['has_contacted' => $hasContacted]);
        }
    }

    public function deleteItem($params, $options)
    {
        if ($options['task'] == 'delete-item') {
            self::where('id', $params['id'])->delete();
        }
    }
}
