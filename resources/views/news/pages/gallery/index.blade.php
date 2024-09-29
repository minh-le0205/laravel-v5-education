@extends('news.main')
@section('content')
    <div class="section-category">
        @include('news.blocks.breadcrumb', ['itemCategory' => ['name' => $title]])
        <div class="content_container container_category">
            <div class="featured_title">
                <div class="container">
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-lg-12">
                            @include('news.pages.gallery.child-index.list', ['items' => $items])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
