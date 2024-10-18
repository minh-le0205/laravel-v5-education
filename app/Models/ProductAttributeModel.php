<?php

namespace App\Models;

use DB;
use App\Models\AdminModel;

class ProductAttributeModel extends AdminModel
{
    public function __construct()
    {
        $this->table = 'product_attribute';
        $this->folderUpload = 'product_attribute';

        $this->fieldSearchAccepted = [
            'id',
            'product_id',
            'attribute_id',
            'value'
        ];
        $this->crudNotAccepted = [
            '_token'
        ];
    }

    public function getListItems($params, $options = null)
    {
        $result = null;

        if (!empty($params['product_id'])) {
            $query = self::select('value')
                ->where('product_id', $params['product_id'])
                ->where('attribute_id', $params['attribute_id'])
                ->get()->toArray();

            if (!empty($query)) {
                $result = implode('$$', array_column($query, 'value'));
            }
        }


        return $result;
    }
}
