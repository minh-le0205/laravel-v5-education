@extends('news.main')
@section('content')
    <div class="section-category">
        @include('news.blocks.breadcrumb', ['itemCategory' => ['name' => $title]])
        <div class="content_container container_category">
            <div class="featured_title">
                <div class="container" style="max-width: 1270px;">
                    <div class="row">
                        @include('news.pages.contact.child_index.info_block')
                    </div>

                    <div class="row">
                        @include('news.pages.contact.child_index.map_block')
                        @include('news.pages.contact.child_index.contact_block')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
