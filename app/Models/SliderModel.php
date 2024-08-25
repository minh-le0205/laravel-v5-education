<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class SliderModel extends Model
{
    protected $table = 'slider';
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $fieldSearchAccepted = [
        'id',
        'name',
        'description',
        'link',
    ];


    public function getListItems($params, $options)
    {
        $results = null;
        if ($options['task'] == 'admin-list-item') {
            $query = self::select(
                'id',
                'status',
                'name',
                'description',
                'link',
                'thumb',
                'created',
                'created_by',
                'modified',
                'modified_by'
            );
            if ($params['filter']['status'] != 'all') {
                $query->where('status', $params['filter']['status']);
            }
            if ($params['search']['field'] != "") {
                if ($params['search']['field'] == 'all') {
                    foreach ($this->fieldSearchAccepted as $column) {
                        $query->orWhere($column, "LIKE", "%" . $params['search']['value'] . "%");
                    }
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], "LIKE", "%" . $params['search']['value'] . "%");
                }
            }
            $results = $query->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }

        return $results;
    }

    public function countListItems($params, $options)
    {
        $results = null;
        if ($options['task'] == 'admin-list-item') {
            $query = $this::groupBy("status")->select(
                DB::raw('count(*) as user_count, status')
            );
            if ($params['search']['field'] != "") {
                if ($params['search']['field'] == 'all') {
                    foreach ($this->fieldSearchAccepted as $column) {
                        $query->orWhere($column, "LIKE", "%" . $params['search']['value'] . "%");
                    }
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], "LIKE", "%" . $params['search']['value'] . "%");
                }
            }

            $results = $query->get()->toArray();

        }
        return $results;
    }

    public function saveItem($params, $options)
    {
        if ($options['task'] == 'change-status') {
            $status = $params['currentStatus'] == 'active' ? 'inactive' : 'active';
            self::where('id', $params['id'])
                ->update(['status' => $status]);
        }
    }
}
