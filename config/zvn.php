<?php

return [
    "url" => [
        'admin' => "admin",
    ],
    "format" => [
        "long_time" => "H:m:s d/m/Y",
        "short_time" => "d/m/Y"
    ],
    'template' => [
        'status' => [
            'active' => ['class' => 'btn-primary', 'name' => 'Kích hoạt'],
            'inactive' => ['class' => 'btn-warning', 'name' => 'Chưa kích hoạt'],
            'all' => ['class' => 'btn-success', 'name' => 'Tất cả'],
            'default' => ['class' => 'btn-danger', 'name' => 'Chưa xác định'],
        ]
    ]
];
