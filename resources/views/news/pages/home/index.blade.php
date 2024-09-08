@extends('news.main')
@section('content')
    @include('news.blocks.slider')
    <!-- Content Container -->
    <div class="content_container">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="main_content">
                        <!-- Featured -->
                        @include('news.blocks.featured')
                        <!-- Category -->
                        @include('news.pages.home.child-index.category')
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="col-lg-3">
                    <div class="sidebar">
                        <!-- Latest Posts -->
                        @include('news.blocks.latest_box')
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
@endsection
