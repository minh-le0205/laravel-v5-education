<?php

namespace App\Models;

use App\Models\AdminModel;
use DB;

class CouponModel extends AdminModel
{
    public function __construct()
    {
        $this->table = 'coupon';
        $this->folderUpload = 'coupon';
        $this->fieldSearchAccepted = [
            'id',
            'code',
            'type',
            'value',
            'status'
        ];
        $this->crudNotAccepted = [
            '_token',
            'code_edit',
            'datepicker-coupon'
        ];
    }

    public function getListItems($params, $options)
    {
        $result = null;

        if ($options['task'] == "admin-list-item") {
            $query = $this->select('*');

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

            $result =  $query->orderBy('id', 'asc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }

        if ($options['task'] == 'news-list-items') {
            $query = $this->select('*')
                ->where('status', '=', 'active')
                ->orderBy('id', 'asc');

            $result = $query->get()->toArray();
        }



        return $result;
    }

    public function getItem($params, $options)
    {
        $result = null;

        if ($options['task'] == 'get-item') {
            $result = self::select('*')->where('id', $params['id'])->first();
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
            $params['created_by'] = session('userInfo')['username'];
            $params['created'] = date('Y-m-d H:i:s');
            self::insert($this->prepareParams($params));
        }

        if ($options['task'] == 'edit-item') {
            $params['modified_by'] = session('userInfo')['username'];
            $params['modified'] = date('Y-m-d H:i:s');
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
