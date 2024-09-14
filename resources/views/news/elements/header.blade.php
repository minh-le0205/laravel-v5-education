@php
    use App\Models\CategoryModel as CategoryModel;
    use App\Helpers\Url as UrlHelper;

    $categoryModel = new CategoryModel();
    $itemsCategory = $categoryModel->getListItems(null, ['task' => 'news-list-items']);

    $xhtmlMenu = '';
    if (!empty($itemsCategory)) {
        $xhtmlMenu =
            '<nav class="main_nav"><ul class="main_nav_list d-flex flex-row align-items-center justify-content-start">';

        $categoryIdCurrent = Route::input('category_id');

        foreach ($itemsCategory as $item) {
            $link = UrlHelper::linkCategory($item['id'], $item['name']);

            $classActive = $categoryIdCurrent == $item['id'] ? 'class="active"' : '';

            $xhtmlMenu .= sprintf(
                '
                    <li %s><a href="%s">%s</a></li>
                ',
                $classActive,
                $link,
                $item['name'],
            );
        }
        $xhtmlMenu .= '</ul></nav>';
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
