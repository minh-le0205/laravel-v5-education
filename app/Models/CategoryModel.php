<?php

namespace App\Models;


use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\AdminModel;
use Kalnoy\Nestedset\NodeTrait;

class CategoryModel extends AdminModel
{
    use NodeTrait;

    protected $table = 'category';
    protected $guarded = [];

    public function getListItems($params, $options)
    {
        $results = null;
        if ($options['task'] == 'admin-list-item') {
            $results = self::withDepth()
                ->having('depth', '>', 0)
                ->defaultOrder()
                ->get()
                ->toFlatTree();
        }

        if ($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'name')
                ->where('status', '=', 'active')
                ->limit(8);

            $results = $query->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-is-home') {
            $query = $this->select('id', 'name', 'display')
                ->where('status', '=', 'active')
                ->where('is_home', '=', '1');

            $results = $query->get()->toArray();
        }

        if ($options['task'] == 'admin-list-items-in-selectbox') {
            $query = self::select(
                'id',
                'name'
            )->where('_lft', '<>', NULL)->withDepth()->defaultOrder();

            if (isset($params['id'])) {
                $node = self::find($params['id']);
                $query->where('_lft', '<', $node->_lft)->orWhere('_lft', '>', $node->_rgt);
            }
            $nodes = $query->get()->toFlatTree();

            foreach ($nodes as $value) {
                $results[$value['id']] = str_repeat('|----', $value['depth']) . $value['name'];
            }
        }

        return $results;
    }

    public function getItem($params, $options)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'name', 'parent_id', 'status')->where('id', $params['id'])->first();
        }

        if ($options['task'] == 'news-get-items') {
            $result = self::select('id', 'name', 'display')->where('id', $params['category_id'])->first();
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
            $params['created_by'] = session('userInfo')['username'];
            $params['created'] = date('Y-m-d H:i:s');
            $parent = self::find($params['parent_id']);
            self::create($this->prepareParams($params), $parent);
        }

        if ($options['task'] == 'edit-item') {
            $params['modified_by'] = session('userInfo')['username'];
            $params['modified'] = date('Y-m-d H:i:s');
            $parent = self::find($params['parent_id']);

            $query = $current = self::find($params['id']);
            $query->update($this->prepareParams($params));
            if ($current->parent_id != $params['parent_id']) {
                $query->prependToNode($parent)->save();
            }
        }

        if ($options['task'] == 'change-is-home') {
            $isHome = $params['currentIsHome'] == '1' ? '0' : '1';
            self::where('id', $params['id'])
                ->update(['is_home' => $isHome]);
        }

        if ($options['task'] == 'change-display') {
            $display = $params['currentDisplay'];
            self::where('id', $params['id'])
                ->update(['display' => $display]);
        }
    }

    public function deleteItem($params, $options)
    {
        if ($options['task'] == 'delete-item') {
            $node = self::find($params['id']);
            $node->delete();
        }
    }

    public function move($params = null, $options = null)
    {
        $node = self::find($params['id']);
        $historyBy = session('userInfo')['username'];
        $this->where('id', $params['id'])->update(['modified_by' => $historyBy]);
        if ($params['type'] == 'down') $node->down();
        if ($params['type'] == 'up') $node->up();
    }
}
