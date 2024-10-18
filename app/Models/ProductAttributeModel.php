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
}
