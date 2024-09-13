@php
    use App\Helpers\Template;
@endphp
<div class="sidebar_latest">
    <div class="sidebar_title">Bài viết gần đây</div>
    <div class="latest_posts">
        @foreach ($itemsLatest as $item)
            @php
                $name = $item['name'];
                $createdBy = $item['created_by'];
                $categoryName = $item['category_name'];
                $linkCategory = '#';
                $linkArticle = '#';
                $date = Template::showDatetimeFrontend($item['created']);
                $thumb = asset('news/images/article/' . $item['thumb']);
            @endphp
            <!-- Latest Post -->
            <div class="latest_post d-flex flex-row align-items-start justify-content-start">
                <div>
                    <div class="latest_post_image"><img src="{!! $thumb !!}" alt="{!! $name !!}">
                    </div>
                </div>
                <div class="latest_post_content">
                    <div class="post_category_small cat_video"><a
                            href="{!! $linkCategory !!}">{!! $categoryName !!}</a></div>
                    <div class="latest_post_title"><a href="{!! $linkArticle !!}">{!! $name !!}</a></div>
                    <div class="latest_post_date">{!! $date !!}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
