@extends('admin.main')
@php
    $type = Request::input('type', 'general');
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
                        <li @if ($type == 'general') class="active" @endif>
                            <a href="{{ route('setting', ['type' => 'general']) }}" role="tab">Cấu hình
                                chung</a>
                        </li>
                        <li @if ($type == 'email') class="active" @endif>
                            <a href="{{ route('setting', ['type' => 'email']) }}" role="tab">Email</a>
                        </li>
                        <li @if ($type == 'social') class="active" @endif>
                            <a href="{{ route('setting', ['type' => 'social']) }}" role="tab">Social</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="settingTabContent">
                        <div role="tabpanel"class="tab-pane fade active in">
                            @switch($type)
                                @case('general')
                                    @include('admin.pages.setting.child_index.form_general')
                                @break

                                @case('social')
                                    @include('admin.pages.setting.child_index.form_social')
                                @break

                                @case('email')
                                    @include('admin.pages.setting.child_index.form_email')
                                @break

                                @default
                                    @include('admin.pages.setting.child_index.form_general')
                                @break
                            @endswitch
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
