<?php

namespace App\Helpers;

use Config;

class Template
{
    public static function showItemHistory($by, $time)
    {
        $xhtml = sprintf(
            '<p><i class="fa fa-user"></i>%s</p>
      <p><i class="fa fa-clock-o"></i>%s</p>',
            $by,
            date(Config::get('zvn.format.short_time'), strtotime($time))
        );


        return $xhtml;
    }

    public static function showItemStatus($controllerName, $id, $status)
    {
        $tmplStatus = Config::get('zvn.template.status');

        $route = route($controllerName . '/status', ['status' => $status, 'id' => $id]);

        $xhtml = sprintf(
            '<a href="%s" type="button"
            class="btn btn-round %s">%s</a>',
            $route,
            $tmplStatus[$status]['class'],
            $tmplStatus[$status]['name']
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

    public static function showButtonAction($controllerName, $id)
    {
        $tmpButton = [
            'edit' => ['class' => 'btn-success', 'title' => 'Edit', 'icon' => 'fa-pencil', 'route-name' => $controllerName . '/form'],
            'delete' => ['class' => 'btn-danger btn-delete', 'title' => 'Delete', 'icon' => 'fa-trash', 'route-name' => $controllerName . '/delete'],
            'info' => ['class' => 'btn-info', 'title' => 'View', 'icon' => 'fa-trash', 'route-name' => $controllerName . '/delete'],
        ];

        $buttonInArea = [
            'default' => ['edit', 'delete'],
            'slider' => ['edit', 'delete'],
        ];

        $listBtn = array_key_exists($controllerName, $buttonInArea) ? $buttonInArea[$controllerName] : $buttonInArea['default'];


        $xhtml = '<div class="zvn-box-btn-filter">';

        foreach ($listBtn as $element) {
            $currentBtn = $tmpButton[$element];
            $link = route($currentBtn['route-name'], ['id' => $id]);
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
}
