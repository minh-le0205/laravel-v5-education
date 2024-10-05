<?php

namespace App\Models;

use App\Models\AdminModel;
use DB;

class SettingModel extends AdminModel
{
    public function __construct()
    {
        $this->table = 'setting';
        $this->folderUpload = 'setting';
        $this->fieldSearchAccepted = [
            'id',
            'key_value',
            'value',
            'status'
        ];
        $this->crudNotAccepted = [
            '_token',
            'general-task'
        ];
    }

    public function getListItems($params, $options)
    {
        $result = null;

        if ($options['task'] == "admin-list-items") {
            $query = $this->select('id', 'key_value', 'value', 'status');

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

        if ($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'key_value', 'value', 'status')
                ->where('status', '=', 'active')
                ->orderBy('ordering', 'asc');

            $result = $query->get()->toArray();
        }



        return $result;
    }

    public function getItem($params, $options)
    {
        $result = null;

        if ($params['type'] == 'general') {
            $result = self::select('value')->where('key_value', 'setting-general')->first()->toArray();
        }

        return $result;
    }

    public function countListItems($params, $options)
    {
        $result = null;

        if ($options['task'] == 'admin-list-items') {

            $query = $this::groupBy('status')
                ->select(DB::raw('count(*) as user_count, status'));

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
            $params['created_by'] = "minhle";
            $params['created']    = date('Y-m-d');
            self::insert($this->prepareParams($params));
        }

        if ($options['task'] == 'edit-item') {
            $params['modified_by']   = "minhle";
            $params['modified']      = date('Y-m-d');
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }

        if ($options['task'] == 'setting-general') {
            $type = 'setting-general';
            $value = json_encode($this->prepareParams($params), JSON_UNESCAPED_UNICODE);
            self::where('key_value', $type)->update(['value' => $value]);
        }
    }

    public function deleteItem($params, $options)
    {
        if ($options['task'] == 'delete-item') {
            self::where('id', $params['id'])->delete();
        }
    }
}
