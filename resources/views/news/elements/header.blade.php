@php
    use App\Models\CategoryModel as CategoryModel;
    use App\Models\MenuModel as MenuModel;
    use App\Helpers\Url as UrlHelper;
    use App\Helpers\Template;

    $categoryModel = new CategoryModel();
    $itemsCategory = $categoryModel->getListItems(null, ['task' => 'news-list-items']);

    $menuModel = new MenuModel();
    $itemsMenu = $menuModel->getListItems(null, ['task' => 'news-list-items']);

    $xhtmlMenu = '';
    if (!empty($itemsCategory)) {
        $xhtmlMenu =
            '<nav class="main_nav"><ul class="main_nav_list d-flex flex-row align-items-center justify-content-start">';
        $categoryIdCurrent = Route::input('category_id');
        foreach ($itemsMenu as $item) {
            $target = $item['type_link'] == 'current' ? '_self' : '_blank';
            if ($item['type_menu'] == 'link') {
                $xhtmlMenu .= sprintf(
                    '
                <li><a href="%s" target="%s">%s</a></li>
            ',
                    $item['link'],
                    $target,
                    $item['name'],
                );
            } else {
                $xhtmlMenu .= '<li class="dropdown">';
                $xhtmlMenu .= sprintf(
                    '
                <a data-name="category_article" target="%s" class="dropdown-toggle" data-toggle="dropdown" href="%s">%s
                ',
                    $target,
                    $item['link'],
                    $item['name'],
                );
                $xhtmlMenu .= '<span class="caret"></span></a>';
                if (count($itemsCategory) > 0) {
                    $xhtmlMenu .= '<ul class="dropdown-menu">';
                    Template::showNestedMenu($itemsCategory, $xhtmlMenu);
                    $xhtmlMenu .= '</ul>';
                }
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
