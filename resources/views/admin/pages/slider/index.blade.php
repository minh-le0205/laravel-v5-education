@extends('admin.main')
@php
    use App\Helpers\Template;

    $buttonFilterList = Template::showButtonFilter($controllerName, $countListStatus, $params['filter']['status']);
    $searchArea = Template::showSearchArea($controllerName);
@endphp
@section('content')
    <div class="page-header zvn-page-header clearfix">
        <div class="zvn-page-header-title">
            <h3>Danh sách User</h3>
        </div>
        <div class="zvn-add-new pull-right">
            <a href="/form" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>
        </div>
    </div>
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
                @include('admin.pages.slider.list')
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
