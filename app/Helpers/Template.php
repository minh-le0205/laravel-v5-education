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
        $tmplStatus = [
            'active' => ['class' => 'btn-success', 'name' => 'Active'],
            'inactive' => ['class' => 'btn-warning', 'name' => 'Inactive'],
        ];

        $route = route('status', ['status' => $status, 'id' => $id]);

        $xhtml = sprintf(
            '<a href="%s" type="button"
            class="btn btn-round %s">%s</a>',
            $controllerName . $route,
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
}
