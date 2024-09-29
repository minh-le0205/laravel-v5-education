@extends('admin.main')
@section('content')
    <div class="page-header zvn-page-header clearfix">
        <div class="zvn-page-header-title">
            <h3>Quản lý tập tin</h3>
        </div>
    </div>
    <div class="row">
        <iframe src="/laravel-filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
    </div>
@endsection
