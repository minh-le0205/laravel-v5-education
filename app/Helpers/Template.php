<?php

namespace App\Helpers;

use Config;
use App\Models\CategoryModel;
use App\Models\CategoryProductModel;

class Template
{
    public static function showItemHistory($by, $time)
    {
        $xhtml = '';
        if (!empty($by)) {
            $xhtml = sprintf(
                '<p><i class="fa fa-user" style="margin-right: 5px;"></i>%s</p>
          <p><i class="fa fa-clock-o" style="margin-right: 5px;"></i>%s</p>',
                $by,
                date(Config::get('zvn.format.short_time'), strtotime($time))
            );
        }

        return $xhtml;
    }

    public static function showItemStatus($controllerName, $id, $status)
    {
        $tmplStatus = Config::get('zvn.template.status');

        $route = route($controllerName . '/status', ['status' => $status, 'id' => $id]);

        $xhtml = sprintf(
            '<button data-url="%s" data-class="%s" type="button"
            class="btn btn-round %s status-ajax">%s</button>',
            $route,
            $tmplStatus[$status]['class'],
            $tmplStatus[$status]['class'],
            $tmplStatus[$status]['name']
        );

        return $xhtml;
    }

    public static function showItemIsHome($controllerName, $id, $isHome)
    {
        $tmplStatus = Config::get('zvn.template.is_home');

        $route = route($controllerName . '/isHome', ['is_home' => $isHome, 'id' => $id]);

        $xhtml = sprintf(
            '<button data-url="%s" data-class="%s" type="button"
            class="btn btn-round %s is-home-ajax">%s</button>',
            $route,
            $tmplStatus[$isHome]['class'],
            $tmplStatus[$isHome]['class'],
            $tmplStatus[$isHome]['name']
        );

        return $xhtml;
    }

    public static function showItemThumb($controllerName, $thumbName, $thumbAlt)
    {
        $xhtml = sprintf(
            '<img style="vertical-align: bottom;" width="100%%" height="100%%" src="%s" alt="%s">',
            asset("images/$controllerName/$thumbName"),
            $thumbAlt
        );

        return $xhtml;
    }

    public static function showItemThumbNews($controllerName, $thumbName, $thumbAlt)
    {
        $xhtml = sprintf(
            '<img style="vertical-align: bottom;" width="100%%" height="100%%" src="%s" alt="%s">',
            asset("news/images/$controllerName/$thumbName"),
            $thumbAlt
        );

        return $xhtml;
    }

    public static function showButtonAction($controllerName, $id)
    {
        $tmpButton = Config::get('zvn.template.button');

        $buttonInArea = Config::get('zvn.config.button');

        $listBtn = array_key_exists($controllerName, $buttonInArea) ? $buttonInArea[$controllerName] : $buttonInArea['default'];


        $xhtml = '<div class="zvn-box-btn-filter">';

        foreach ($listBtn as $element) {
            $currentBtn = $tmpButton[$element];
            $link = route($controllerName . $currentBtn['route-name'], ['id' => $id]);
            $xhtml .= sprintf(
                '<a href="%s" type="button" class="btn btn-icon %s"
                data-toggle="tooltip" data-placement="top" data-original-title="%s">
                <i class="fa %s"></i>
                </a>',
                $link,
                $currentBtn['class'],
                $currentBtn['title'],
                $currentBtn['icon'],
            );
        }


        $xhtml .= '</div>';

        return $xhtml;
    }

    public static function showButtonFilter($controllerName, $countListStatus, $currentFilterStatus)
    {
        $xhtml = null;

        $tmpStatusClass = Config::get('zvn.template.status');

        if ($countListStatus > 0) {
            array_unshift($countListStatus, [
                'user_count' => array_sum(array_column($countListStatus, 'user_count')),
                'status' => 'all'
            ]);
            foreach ($countListStatus as $value) {
                $statusName = array_key_exists($value['status'], $tmpStatusClass) ? $tmpStatusClass[$value['status']]['name'] : $tmpStatusClass['default']['name'];
                $link = route($controllerName) . '?filter_status=' . $value['status'];
                $currentActiveClass = ($currentFilterStatus == $value['status']) ? 'btn-primary' : 'btn-info';
                $xhtml .= sprintf(
                    '
                <a href="%s" type="button" class="btn %s">
                                %s <span class="badge bg-white">%s</span>
                            </a>
                ',
                    $link,
                    $currentActiveClass,
                    $statusName,
                    $value['user_count'],
                );
            }
        }


        return $xhtml;
    }

    public static function showButtonFilterContact($controllerName, $countListStatus, $currentFilterStatus)
    {
        $xhtml = null;

        $tmpStatusClass = Config::get('zvn.template.has_contacted');

        if ($countListStatus > 0) {
            array_unshift($countListStatus, [
                'user_count' => array_sum(array_column($countListStatus, 'user_count')),
                'has_contacted' => 'all'
            ]);
            foreach ($countListStatus as $value) {
                $statusName = array_key_exists($value['has_contacted'], $tmpStatusClass) ? $tmpStatusClass[$value['has_contacted']]['name'] : $tmpStatusClass['default']['name'];
                $link = route($controllerName) . '?filter_status=' . $value['has_contacted'];
                $currentActiveClass = ($currentFilterStatus == $value['has_contacted']) ? 'btn-primary' : 'btn-info';
                $xhtml .= sprintf(
                    '
                <a href="%s" type="button" class="btn %s">
                                %s <span class="badge bg-white">%s</span>
                            </a>
                ',
                    $link,
                    $currentActiveClass,
                    $statusName,
                    $value['user_count'],
                );
            }
        }


        return $xhtml;
    }

    public static function showSearchArea($controllerName)
    {
        $xhtml = null;

        $tmpFields = Config::get('zvn.template.search');

        $moduleFields = Config::get('zvn.config.search');

        $controllerFields = array_key_exists($controllerName, $moduleFields) ? $moduleFields[$controllerName] : $moduleFields['default'];

        $xhtmlFields = null;

        foreach ($controllerFields as $field) {
            $xhtmlFields .= sprintf(
                '
                    <li><a href="#" class="select-field" data-field="%s">%s</a></li>
                ',
                $field,
                $tmpFields[$field]['name']
            );
        }



        $xhtml = sprintf(
            '
            <div class="input-group">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle btn-active-field"
                        data-toggle="dropdown" aria-expanded="false">
                        Search by All <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        %s
                    </ul>
                </div>
                <input type="text" class="form-control" name="search_value" value="">
                <span class="input-group-btn">
                    <button id="btn-clear" type="button" class="btn btn-success"
                        style="margin-right: 0px">Xóa tìm kiếm</button>
                    <button id="btn-search" type="button" class="btn btn-primary">Tìm
                        kiếm</button>
                </span>
                <input type="hidden" name="search_field" value="all">
            </div>
            ',
            $xhtmlFields
        );

        return $xhtml;
    }

    public static function showItemSelect($controllerName, $id, $displayValue, $field)
    {
        $link = route($controllerName . '/' . $field, [$field => 'value_new', 'id' => $id]);
        $templateConfig = Config::get('zvn.template.' . $field);
        $xhtml = sprintf('<select name="select_change_attr" data-url="%s" class="form-control">', $link);
        foreach ($templateConfig as $key => $value) {
            $xhtmlSelected = "";
            if ($key == $displayValue)
                $xhtmlSelected = 'selected="selected"';

            $xhtml .= sprintf(
                '<option value="%s" %s>%s</option>',
                $key,
                $xhtmlSelected,
                $value['name']
            );
        }
        $xhtml .= '</select>';
        return $xhtml;
    }

    public static function showDatetimeFrontend($dateTime)
    {
        return date_format(date_create($dateTime), Config::get('zvn.format.short_time'));
    }

    public static function showContent($content, $length, $prefix = "...")
    {
        $prefix = ($length == 0) ? '' : $prefix;
        $content = str_replace([
            '<p>',
            '</p>'
        ], '', $content);

        return preg_replace('/\s+?(\S+)?$/', '', substr($content, 0, $length)) . $prefix;
    }

    public static function showItemOrdering($controllerName, $orderingValue, $id)
    {
        $link = route($controllerName . '/ordering', ['ordering' => 'value_new', 'id' => $id]);
        $xhtml = sprintf('
            <input min="0" style="width:60px;margin-left:30%%" type="number" class="form-control ordering" id="ordering-%s" data-url="%s" value="%s"/>
        ', $id, $link, $orderingValue);

        return $xhtml;
    }

    public static function showItemHasContacted($controllerName, $id, $hasContacted)
    {
        $tmplStatus = Config::get('zvn.template.has_contacted');

        $route = route($controllerName . '/hasContacted', ['has_contacted' => $hasContacted, 'id' => $id]);

        $xhtml = sprintf(
            '<button data-url="%s" data-class="%s" type="button"
            class="btn btn-round %s is-home-ajax">%s</button>',
            $route,
            $tmplStatus[$hasContacted]['class'],
            $tmplStatus[$hasContacted]['class'],
            $tmplStatus[$hasContacted]['name']
        );

        return $xhtml;
    }

    public static function showNestedSetName($name, $level)
    {
        $xhtml = str_repeat("|------", $level - 1);
        $xhtml .= sprintf(
            '
            <span class="badge badge-danger p-1">%s</span> <strong>%s</strong>
        ',
            $level,
            $name
        );

        return $xhtml;
    }



    public static function showNestedSetUpDown($controllerName, $id)
    {
        $upButton = sprintf(
            '
        <a href="%s" type="button" class="btn btn-primary mb-0" data-toggle="tooltip" title="" data-original-title="Up"> <i class="fa fa-long-arrow-up"></i>
        </a>',
            route("$controllerName/move", ['id' => $id, 'type' => 'up'])
        );

        $downButton = sprintf(
            '
            <a href="%s" type="button" class="btn btn-primary mb-0" data-toggle="tooltip" title="" data-original-title="Down"> <i class="fa fa-long-arrow-down"></i>
            </a>',
            route("$controllerName/move", ['id' => $id, 'type' => 'down'])
        );

        $node = null;

        switch ($controllerName) {
            case 'categoryProduct':
                $node = CategoryProductModel::find($id);
                break;

            case 'category':
                $node = CategoryModel::find($id);
                break;
        }

        if (empty($node->getPrevSibling()) || empty($node->getPrevSibling()->parent_id)) $upButton = '';
        if (empty($node->getNextSibling())) $downButton = '';
        $xhtml = '
            <span style="width: 36px; display: inline-block">' . $upButton . '</span>
            <span style="width: 36px; display: inline-block">' . $downButton . '</span>
        ';


        return $xhtml;
    }

    public static function showNestedMenu($items, &$xhtml)
    {
        foreach ($items as $item) {
            $link = Url::linkCategory($item['id'], $item['name']);
            if (count($item['children'])) {
                $xhtml .= '<li class="nav-item">';
                $xhtml .= sprintf('<a href="%s" class="nav-link dropdown-item">%s<span class="fa fa-caret-right" style="margin-left:7px;"></span></a><ul class="submenu dropdown-menu">', $link, $item['name']);
                Template::showNestedMenu($item['children'], $xhtml);
                $xhtml .= '</ul></li>';
            } else {
                $xhtml .= sprintf('<li class="nav-item"> <a class="nav-link dropdown-item" href="%s">%s</a></li>', $link, $item['name']);
            }
        }
    }
}