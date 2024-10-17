<?php

namespace App\Models;

use DB;
use App\Models\AdminModel;
use App\Models\CategoryProductModel;

class ProductModel extends AdminModel
{
    public function __construct()
    {
        $this->table = 'product';
        $this->folderUpload = 'product';
        $this->fieldSearchAccepted = [
            'name',
            'content',
            'status'
        ];
        $this->crudNotAccepted = [
            '_token',
            'thumb_current'
        ];
    }

    public function getListItems($params, $options)
    {
        $results = null;
        if ($options['task'] == 'admin-list-item') {
            $query = self::select(
                'product.id',
                'product.status',
                'product.name',
                'content',
                'thumb',
                'product.created',
                'product.created_by',
                'product.modified',
                'product.modified_by',
                'category_product.name as category_name',
                'product.category_id'
            )->leftJoin('category_product', 'product.category_id', '=', 'category_product.id');
            if ($params['filter']['status'] != 'all') {
                $query->where('product.status', $params['filter']['status']);
            }

            if ($params['filter']['category'] != 'all') {
                $categories = CategoryProductModel::descendantsAndSelf($params['filter']['category'])->pluck('id')->toArray();
                $query->whereIn('product.category_id', $categories);
            }


            if ($params['search']['field'] != "") {
                if ($params['search']['field'] == 'all') {
                    foreach ($this->fieldSearchAccepted as $column) {
                        $query->orWhere("product." . $column, "LIKE", "%" . $params['search']['value'] . "%");
                    }
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], "LIKE", "%" . $params['search']['value'] . "%");
                }
            }
            $results = $query->orderBy('product.id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }

        if ($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'name', 'description', 'link', 'thumb')
                ->where('product.status', '=', 'active')
                ->limit(5);

            $results = $query->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-feature') {
            $query = $this->select(
                'product.id',
                'product.name',
                'product.content',
                'product.created',
                'product.category_id',
                'category_product.name as category_name',
                'product.thumb',
                'product.created_by'
            )->leftJoin('category_product', 'product.category_id', '=', 'category_product.id')
                ->where('product.status', 'active')
                ->where('product.type', 'feature')
                ->orderBy('id', 'desc')
                ->take(3);

            $results = $query->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-latest') {
            $query = $this->select(
                'product.id',
                'product.name',
                'product.content',
                'product.created',
                'product.category_id',
                'category_product.name as category_name',
                'product.thumb',
                'product.created_by'
            )->leftJoin('category_product', 'product.category_id', '=', 'category_product.id')
                ->where('product.status', 'active')
                ->orderBy('publish_at', 'desc')
                ->take(4);

            $results = $query->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-category') {
            $query = $this->select(
                'product.id',
                'product.name',
                'product.content',
                'product.created',
                'product.category_id',
                'product.thumb',
                'product.created_by'
            )
                ->where('product.status', 'active')
                ->where('product.category_id', '=', $params['category_id'])
                ->orderBy('id', 'desc')
                ->take(4);

            $results = $query->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-related-in-category') {
            $query = $this->select(
                'product.id',
                'product.name',
                'product.content',
                'product.created',
                'product.category_id',
                'category_product.name as category_name',
                'product.thumb',
                'product.created_by'
            )->leftJoin('category_product', 'product.category_id', '=', 'category_product.id')
                ->where('product.id', '!=', $params['product_id'])
                ->where('product.category_id', '=', $params['category_id'])
                ->orderBy('id', 'desc')
                ->take(4);

            $results = $query->get()->toArray();
        }

        return $results;
    }

    public function getItem($params, $options)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'name', 'content', 'status', 'thumb', 'category_id')->where('id', $params['id'])->first();
        }

        if ($options['task'] == 'get-thumb') {
            $result = self::select('id', 'thumb')->where('id', $params['id'])->first();
        }

        if ($options['task'] == 'news-get-items') {
            $result = self::select(
                'product.id',
                'product.name',
                'product.content',
                'product.category_id',
                'category_product.name as category_name',
                'product.thumb',
                'product.created',
                'product.created_by'
            )
                ->leftJoin('category_product', 'category_product.id', '=', 'product.category_id')
                ->where('product.id', $params['product_id'])
                ->where('product.status', '=', 'active')
                ->first();
            if (!empty($result)) {
                $result = $result->toArray();
            }
        }

        return $result;
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
        if ($options['task'] == 'add-item') {
            $params['thumb'] = $this->uploadThumbNews($params['thumb']);
            $params['created_by'] = 'minhle';
            $params['created'] = Date('Y-m-d');
            $params = $this->prepareParams($params);
            self::insert($params);
        }

        if ($options['task'] == 'edit-item') {
            if (!empty($params['thumb'])) {
                $this->deleteThumbNews($params['thumb_current']);
                $params['thumb'] = $this->uploadThumbNews($params['thumb']);
            }
            $params['modified_by'] = 'minhle';
            $params['modified'] = Date('Y-m-d');
            $params = $this->prepareParams($params);
            self::where('id', $params['id'])->update($params);
        }

        if ($options['task'] == 'change-category') {
            $params['modified_by'] = session('userInfo')['username'];
            $params['modified'] = date('Y-m-d H:i:s');
            self::where('id', $params['id'])
                ->update($this->prepareParams($params));
        }
    }

    public function deleteItem($params, $options)
    {
        if ($options['task'] == 'delete-item') {
            $item = self::getItem($params, ['task' => 'get-thumb']);
            $this->deleteThumbNews($item['thumb']);
            self::where('id', $params['id'])->delete();
        }
    }
}
