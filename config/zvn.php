<?php

return [
    "url" => [
        'prefix_admin' => "admin",
        'prefix_news' => "newsx",
    ],
    "format" => [
        "long_time" => "H:m:s d/m/Y",
        "short_time" => "d/m/Y"
    ],
    'template' => [
        'form_label' => [
            'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
        ],
        'form_input' => [
            'class' => 'form-control col-md-6 col-xs-12'
        ],
        'form_label_edit' => [
            'class' => 'control-label col-md-4 col-sm-3 col-xs-12'
        ],
        'form_ckeditor' => [
            'class' => 'form-control col-md-6 col-xs-12 ckeditor'
        ],
        'status' => [
            'active' => ['class' => 'btn-primary', 'name' => 'Kích hoạt'],
            'inactive' => ['class' => 'btn-warning', 'name' => 'Chưa kích hoạt'],
            'all' => ['class' => 'btn-success', 'name' => 'Tất cả'],
            'default' => ['class' => 'btn-danger', 'name' => 'Chưa xác định'],
        ],
        'is_home' => [
            '0' => ['class' => 'btn-primary', 'name' => 'Hiển thị'],
            '1' => ['class' => 'btn-warning', 'name' => 'Không hiển thị'],
        ],
        'display' => [
            'list' => ['name' => 'Danh sách'],
            'grid' => ['name' => 'Lưới'],
        ],
        'type' => [
            'normal' => ['name' => 'Bình thường'],
            'feature' => ['name' => 'Nổi bật'],
        ],
        'rss_source' => [
            'vnexpress'   => ['name' => 'VNExpress'],
            'tuoitre'     => ['name' => 'Tuổi Trẻ'],
        ],
        'level'       => [
            'admin'      => ['name' => 'Quản trị hệ thống'],
            'member'      => ['name' => 'Người dùng bình thường'],
        ],
        'type_menu' => [
            'link' => ['name' => 'Link'],
            'category_article' => ['name' => 'Danh mục bài viết']
        ],
        'type_link' => [
            'current' => ['name' => 'Trang hiện tại'],
            'new_tab' => ['name' => 'Tab mới']
        ],
        'search' => [
            'all' => ['name' => 'Search By All'],
            'id' => ['name' => 'Search By ID'],
            'name' => ['name' => 'Search By Name'],
            'username' => ['name' => 'Search By Username'],
            'fullname' => ['name' => 'Search By Full Name'],
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
            'category' => ['all', 'id', 'name'],
            'article' => ['all', 'name', 'content'],
            'user'      => ['all', 'username', 'email', 'fullname'],
            'rss'       => ['all', 'name', 'link'],
            'menu'       => ['all', 'name'],
        ],
        'button' => [
            'default' => ['edit', 'delete'],
            'slider' => ['edit', 'delete'],
            'category' => ['edit', 'delete'],
            'article' => ['edit', 'delete'],
            'user'      => ['edit'],
            'rss'   => ['edit', 'delete'],
            'menu' => ['edit', 'delete']
        ]
    ],
    'notify' => [
        'update' => [
            'success' => 'Cập nhật thành công',
            'failed' => 'Cập nhật thất bại',
        ]
    ]
];
