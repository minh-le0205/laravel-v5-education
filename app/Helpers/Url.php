<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Url
{
    public static function linkCategory($id, $name)
    {
        return route('category/index', [
            'category_id' => $id,
            'category_name' => Str::slug($name),
        ]);
    }

}