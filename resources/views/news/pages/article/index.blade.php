@extends('news.main')
@section('content')
    <div class="section-category">
        @include('news.blocks.breadcrumb_article', [
            'item' => $itemArticle,
        ])
        <div class="content_container container_category">
            <div class="featured_title">
                <div class="container">
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-lg-9">
                            <div class="single_post">
                                @include('news.pages.article.child-index.article', [
                                    'item' => $itemArticle,
                                ])
                                @include('news.pages.article.child-index.related', [
                                    'item' => $itemArticle,
                                ])
                            </div>
                        </div>
                        <!-- Sidebar -->
                        <div class="col-lg-3">
                            <div class="sidebar">
                                <!-- Latest Posts -->
                                @include('news.blocks.latest_box', ['itemsLatest' => $itemsLatest])
                                <!-- Advertisement -->
                                @include('news.blocks.advertisements')
                                <!-- Most Viewed -->
                                @include('news.blocks.most_viewed')
                                <!-- Tags -->
                                @include('news.blocks.tags')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
