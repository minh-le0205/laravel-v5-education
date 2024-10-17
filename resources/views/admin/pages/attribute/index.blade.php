@extends('admin.main')
@php
    use App\Helpers\Template;

    $buttonFilterList = Template::showButtonFilter($controllerName, $countListStatus, $params['filter']['status']);
    $searchArea = Template::showSearchArea($controllerName);
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
                        <div class="col-md-7">
                            {!! $buttonFilterList !!}
                        </div>
                        <div class="col-md-5">
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
                @include('admin.pages.attribute.list')
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
