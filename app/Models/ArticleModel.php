<?php

namespace App\Models;


use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\AdminModel;
use App\Models\CategoryModel;

class ArticleModel extends AdminModel
{
    public function __construct()
    {
        $this->table = 'article';
        $this->folderUpload = 'article';
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
                'article.id',
                'article.status',
                'article.name',
                'content',
                'thumb',
                'article.created',
                'article.created_by',
                'article.modified',
                'article.modified_by',
                'category.name as category_name',
                'article.type',
                'article.category_id'
            )->leftJoin('category', 'article.category_id', '=', 'category.id');
            if ($params['filter']['status'] != 'all') {
                $query->where('article.status', $params['filter']['status']);
            }

            if ($params['filter']['category'] != 'all') {
                $categories = CategoryModel::descendantsAndSelf($params['filter']['category'])->pluck('id')->toArray();
                $query->whereIn('article.category_id', $categories);
            }


            if ($params['search']['field'] != "") {
                if ($params['search']['field'] == 'all') {
                    foreach ($this->fieldSearchAccepted as $column) {
                        $query->orWhere("article." . $column, "LIKE", "%" . $params['search']['value'] . "%");
                    }
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], "LIKE", "%" . $params['search']['value'] . "%");
                }
            }
            $results = $query->orderBy('article.id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }

        if ($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'name', 'description', 'link', 'thumb')
                ->where('article.status', '=', 'active')
                ->limit(5);

            $results = $query->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-feature') {
            $query = $this->select(
                'article.id',
                'article.name',
                'article.content',
                'article.created',
                'article.category_id',
                'category.name as category_name',
                'article.thumb',
                'article.created_by'
            )->leftJoin('category', 'article.category_id', '=', 'category.id')
                ->where('article.status', 'active')
                ->where('article.type', 'feature')
                ->orderBy('id', 'desc')
                ->take(3);

            $results = $query->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-latest') {
            $query = $this->select(
                'article.id',
                'article.name',
                'article.content',
                'article.created',
                'article.category_id',
                'category.name as category_name',
                'article.thumb',
                'article.created_by'
            )->leftJoin('category', 'article.category_id', '=', 'category.id')
                ->where('article.status', 'active')
                ->orderBy('publish_at', 'desc')
                ->take(4);

            $results = $query->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-category') {
            $query = $this->select(
                'article.id',
                'article.name',
                'article.content',
                'article.created',
                'article.category_id',
                'article.thumb',
                'article.created_by'
            )
                ->where('article.status', 'active')
                ->where('article.category_id', '=', $params['category_id'])
                ->orderBy('id', 'desc')
                ->take(4);

            $results = $query->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-related-in-category') {
            $query = $this->select(
                'article.id',
                'article.name',
                'article.content',
                'article.created',
                'article.category_id',
                'category.name as category_name',
                'article.thumb',
                'article.created_by'
            )->leftJoin('category', 'article.category_id', '=', 'category.id')
                ->where('article.id', '!=', $params['article_id'])
                ->where('article.category_id', '=', $params['category_id'])
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
                'article.id',
                'article.name',
                'article.content',
                'article.category_id',
                'category.name as category_name',
                'article.thumb',
                'article.created',
                'article.created_by',
                'category.display'
            )
                ->leftJoin('category', 'category.id', '=', 'article.category_id')
                ->where('article.id', $params['article_id'])
                ->where('article.status', '=', 'active')
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

        if ($options['task'] == 'change-type') {
            $type = $params['currentType'];
            self::where('id', $params['id'])
                ->update(['type' => $type]);
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
