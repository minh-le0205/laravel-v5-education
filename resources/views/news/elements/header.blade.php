@php
    use App\Models\CategoryModel as CategoryModel;
    use App\Models\MenuModel as MenuModel;
    use App\Helpers\Url as UrlHelper;

    $categoryModel = new CategoryModel();
    $itemsCategory = $categoryModel->getListItems(null, ['task' => 'news-list-items']);

    $menuModel = new MenuModel();
    $itemsMenu = $menuModel->getListItems(null, ['task' => 'news-list-items']);

    $xhtmlMenu = '';
    if (!empty($itemsCategory)) {
        $xhtmlMenu =
            '<nav class="main_nav"><ul class="main_nav_list d-flex flex-row align-items-center justify-content-start">';
        $categoryIdCurrent = Route::input('category_id');
        $currentUri = !empty(basename(request()->path())) ? '/' . basename(request()->path()) : '/';
        foreach ($itemsMenu as $item) {
            $target = $item['type_link'] == 'current' ? '_self' : '_blank';
            $classActiveMenu = $item['link'] == $currentUri ? 'active' : '';
            if ($item['type_menu'] == 'link') {
                $xhtmlMenu .= sprintf(
                    '
                <li class="%s"><a href="%s" target="%s">%s</a></li>
            ',
                    $classActiveMenu,
                    $item['link'],
                    $target,
                    $item['name'],
                );
            } else {
                $xhtmlMenu .= sprintf('<li class="dropdown %s">', $classActiveMenu);
                $xhtmlMenu .= sprintf(
                    '
                <a target="%s" class="dropdown-toggle" data-toggle="dropdown" href="%s">%s
                ',
                    $target,
                    $item['link'],
                    $item['name'],
                );
                $xhtmlMenu .= '<span class="caret"></span></a>';
                $xhtmlMenu .= '<ul class="dropdown-menu">';
                foreach ($itemsCategory as $item) {
                    $link = UrlHelper::linkCategory($item['id'], $item['name']);

                    $classActive = $categoryIdCurrent == $item['id'] ? 'class="active"' : '';

                    $xhtmlMenu .= sprintf(
                        '
                    <li %s><a style="margin:16px;" href="%s">%s</a></li>
                ',
                        $classActive,
                        $link,
                        $item['name'],
                    );
                }
                $xhtmlMenu .= '</ul>';
                $xhtmlMenu .= '</li>';
            }
        }

        if (empty(session('userInfo'))) {
            $xhtmlMenuUser = sprintf('<li><a href="%s">%s</a></li>', route('auth/login'), 'Đăng nhập');
        } else {
            $xhtmlMenuUser = sprintf('<li><a href="%s">%s</a></li>', route('auth/logout'), 'Đăng xuất');
        }

        $xhtmlAdmin = '';
        if (!empty(session('userInfo')) && session('userInfo')['level'] == 'admin') {
            $xhtmlAdmin = sprintf('<li><a href="%s">%s</a></li>', route('dashboard'), 'Admin');
        }

        $xhtmlMenu .= $xhtmlMenuUser . $xhtmlAdmin . '</ul></nav>';
    }

@endphp

<header class="header">
    <!-- Header Content -->
    <div class="header_content_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justfy-content-start">
                        <div class="logo_container">
                            <a href="{{ route('home') }}">
                                <div class="logo"><span>ZEND</span>VN</div>
                            </a>
                        </div>
                        <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">
                            <a href="#">
                                <div class="background_image"
                                    style="background-image:url({{ asset('news/images/zendvn-online.png') }});background-size: contain">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Navigation & Search -->
    <div class="header_nav_container" id="header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_nav_content d-flex flex-row align-items-center justify-content-start">
                        <!-- Logo -->
                        <div class="logo_container">
                            <a href="#">
                                <div class="logo"><span>ZEND</span>VN</div>
                            </a>
                        </div>
                        <!-- Navigation -->
                        {!! $xhtmlMenu !!}
                        <!-- Hamburger -->
                        <div class="hamburger ml-auto menu_mm"><i class="fa fa-bars  trans_200 menu_mm"
                                aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
