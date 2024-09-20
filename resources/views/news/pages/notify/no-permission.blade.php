@extends('news.main')
@section('content')
    <div class="content_container">
        <div class="container">
            <div class="row">

                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="main_content">
                        <h3>Bạn không có quyền truy cập vào chức năng này!! </h3>

                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-3">
                    <div class="sidebar">
                        <!-- Latest Posts -->
                        @include ('news.blocks.latest_box', ['items' => $itemsLatest])

                        <!-- Advertisement -->
                        @include ('news.blocks.advertisements', ['itemsAdvertisement' => []])

                        <!-- MostViewed -->
                        @include ('news.blocks.most_viewed', ['itemsMostViewed' => []])

                        <!-- Tags -->
                        @include ('news.blocks.tags', ['itemsTags' => []])
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
