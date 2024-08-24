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
        ],
        'search' => [
            'all' => ['name' => 'Search By All'],
            'id' => ['name' => 'Search By ID'],
            'name' => ['name' => 'Search By Name'],
            'username' => ['name' => 'Search By Username'],
            'full_name' => ['name' => 'Search By Full Name'],
            'email' => ['name' => 'Search By Email'],
            'description' => ['name' => 'Search By Description'],
            'link' => ['name' => 'Search By Link'],
            'content' => ['name' => 'Search By Content'],
        ],
        'button' => [
            'edit' => ['class' => 'btn-success', 'title' => 'Edit', 'icon' => 'fa-pencil', 'route-name' => '/form'],
            'delete' => ['class' => 'btn-danger btn-delete', 'title' => 'Delete', 'icon' => 'fa-trash', 'route-name' => '/delete'],
            'info' => ['class' => 'btn-info', 'title' => 'View', 'icon' => 'fa-trash', 'route-name' => '/delete'],
        ]
    ],
    'config' => [
        'search' => [
            'default' => ['id', 'all'],
            'slider' => ['all', 'id', 'name', 'description', 'link'],
        ],
        'button' => [
            'default' => ['edit', 'delete'],
            'slider' => ['edit', 'delete'],
        ]
    ]
];
