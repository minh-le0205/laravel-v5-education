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
            $results = $query->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }

        return $results;
    }

    public function countListItems($params, $options)
    {
        $results = null;
        if ($options['task'] == 'admin-list-item') {
            $results = self::select(
                DB::raw('count(*) as user_count, status')
            )
                ->groupBy('status')
                ->get()->toArray();
        }
        return $results;
    }
}
