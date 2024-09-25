@extends('admin.main')
@section('content')
    <div class="page-header zvn-page-header clearfix">
        <div class="zvn-page-header-title">
            <h3>Quản lý thống kê</h3>
        </div>
    </div>
    <div class="row" style="display: inline-block;">
        <div class="top_tiles">
            @foreach ($dashboardData as $item)
                <div class="col-md-6" style="width:250px">
                    <div class="tile-stats">
                        <div class="icon"><i class="{!! $item['icon'] !!}"></i></div>
                        <div class="count">{!! $item['count'] !!}</div>
                        <h4 style="padding-left:5%;">{!! $item['text'] !!}</h4>
                        <a style="padding-left:66%;" href="{!! $item['link'] !!}">Xem chi tiết</a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
