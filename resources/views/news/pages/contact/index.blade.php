@extends('news.main')
@section('content')
    <div class="section-category">
        @include('news.blocks.breadcrumb', ['itemCategory' => ['name' => $title]])
        <div class="content_container container_category">
            <div class="featured_title">
                <div class="container">
                    <div class="row"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
