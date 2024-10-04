@extends('admin.main')
@php
    $type = Route::input('type');
@endphp
@section('content')
    <div class="page-header zvn-page-header clearfix">
        <div class="zvn-page-header-title">
            <h3>Quản lý Setting</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
                                aria-controls="general" aria-selected="true">Cấu hình chung</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="email-tab" data-toggle="tab" href="#email" role="tab"
                                aria-controls="email" aria-selected="true">Email</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" id="social-tab" data-toggle="tab" href="#social" role="tab"
                                aria-controls="social" aria-selected="true">Home</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        {{-- @include('admin.pages.setting.child_index.form_general')
                        @include('admin.pages.setting.child_index.form_email')
                        @include('admin.pages.setting.child_index.form_social') --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
