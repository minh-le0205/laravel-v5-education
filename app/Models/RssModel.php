<?php

namespace App\Models;

use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\AdminModel;

class RssModel extends AdminModel
{
    public function __construct()
    {
        $this->table = 'rss';
        $this->folderUpload = 'rss';
        $this->fieldSearchAccepted = [
            'id',
            'name',
            'link',
            'description'
        ];
        $this->crudNotAccepted = [
            '_token'
        ];
    }

    public function getListItems($params, $options)
    {
        $result = null;

        if ($options['task'] == "admin-list-items") {
            $query = $this->select('id', 'name', 'status', 'link', 'ordering', 'source', 'created', 'created_by', 'modified', 'modified_by');

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
            $query = $this->select('id', 'link', 'source')
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
            $result = self::select('id', 'name', 'status', 'link', 'ordering', 'source')->where('id', $params['id'])->first();
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
    }

    public function deleteItem($params, $options)
    {
        if ($options['task'] == 'delete-item') {
            self::where('id', $params['id'])->delete();
        }
    }
}
