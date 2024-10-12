@extends('admin.main')
@php
    use App\Helpers\Template;
    use App\Models\CategoryModel;

    $buttonFilterList = Template::showButtonFilter($controllerName, $countListStatus, $params['filter']['status']);
    $searchArea = Template::showSearchArea($controllerName);

    $categoryModel = new CategoryModel();
    $itemsCategory = $categoryModel->getListItems(null, ['task' => 'admin-list-items-in-selectbox-for-article']);

    $formInputAttr = config('zvn.template.form_input');

@endphp
@section('content')
    @include('admin.templates.page_header', ['pageIndex' => true])
    @include('admin.templates.zvn_notify')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Bộ lọc'])
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-4">
                            {!! $buttonFilterList !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::select(
                                'filter_category',
                                ['all' => 'Tất cả'] + $itemsCategory,
                                request()->get('filter_category', 'all'),
                                $formInputAttr + ['data-url' => ''],
                            ) !!}
                        </div>
                        <div class="col-md-6">
                            {!! $searchArea !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--box-lists-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Danh sách'])
                @include('admin.pages.article.list', ['itemsCategory' => $itemsCategory])
            </div>
        </div>
    </div>
    <!--end-box-lists-->
    <!--box-pagination-->
    @if (count($items) > 0)
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    @include('admin.templates.x_title', ['title' => 'Phân trang'])
                    @include('admin.templates.pagination', ['items' => $items])
                </div>
            </div>
        </div>
    @endif
@endsection
