@php
    $title = 'Quản lý ' . ucfirst($controllerName);

    $link = route($controllerName);
    $icon = 'fa-arrow-left';
    $text = 'Quay về';
    if ($pageIndex == true) {
        $link = route($controllerName . '/form');
        $icon = 'fa-plus-circle';
        $text = 'Thêm mới';
    }
    $pageButton = sprintf('<a href="%s" class="btn btn-success"><i class="fa %s"></i> %s</a>', $link, $icon, $text);
@endphp
<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>{{ $title }}</h3>
    </div>
    <div class="zvn-add-new pull-right">
        {!! $pageButton !!}
    </div>
</div>
