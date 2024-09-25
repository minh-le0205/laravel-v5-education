<?php

namespace App\Models;

use App\Models\AdminModel;
use DB;

class MenuModel extends AdminModel
{
    public function __construct()
    {
        $this->table = 'menu';
        $this->folderUpload = 'menu';
        $this->fieldSearchAccepted = [
            'id',
            'name',
            'status',
            'link',
            'ordering'
        ];
        $this->crudNotAccepted = [
            '_token'
        ];
    }

    public function getListItems($params, $options)
    {
        $result = null;

        if ($options['task'] == "admin-list-item") {
            $query = $this->select('id', 'name', 'status', 'link', 'ordering', 'type_menu', 'type_link');

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
            $query = $this->select('id', 'name', 'status', 'link', 'ordering', 'type_menu', 'type_link')
                ->where('status', '=', 'active')
                ->orderBy('ordering', 'asc');

            $result = $query->get()->toArray();
        }



        return $result;
    }

    public function getItem($params, $options)
    {
        $result = null;

        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'name', 'status', 'link', 'ordering', 'type_menu', 'type_link')->where('id', $params['id'])->first();
        }

        return $result;
    }

    public function countListItems($params, $options)
    {
        $result = null;

        if ($options['task'] == 'admin-list-item') {

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
            self::insert($this->prepareParams($params));
        }

        if ($options['task'] == 'edit-item') {
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }

    public function deleteItem($params, $options)
    {
        if ($options['task'] == 'delete-item') {
            self::where('id', $params['id'])->delete();
        }
    }
}