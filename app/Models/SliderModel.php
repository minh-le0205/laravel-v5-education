<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
            $results = self::select(
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
            )
                ->paginate($params['pagination']['totalItemsPerPage']);
        }

        return $results;
    }
}
