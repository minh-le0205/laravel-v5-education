@php
    use App\Helpers\Template;
    $name = $item['name'];
    $createdBy = $item['created_by'];
    $categoryName = isset($item['category_name']) ? $item['category_name'] : null;
    $linkCategory = '#';
    $linkArticle = '#';
    $date = Template::showDatetimeFrontend($item['created']);
    $content = Template::showContent($item['content'], $lengthContent);
@endphp
<div class="post_content">
    @if ($showCategory)
        <div class="post_category cat_technology">
            <a href="{!! $linkCategory !!}">{!! $item['category_name'] !!}</a>
        </div>
    @endif
    <div class="post_title"><a href="{!! $linkArticle !!}">{!! $name !!}</a>
    </div>
    <div class="post_info d-flex flex-row align-items-center justify-content-start">
        <div class="post_author d-flex flex-row align-items-center justify-content-start">
            <div class="post_author_name"><a href="#">{!! $createdBy !!}</a>
            </div>
        </div>
        <div class="post_date"><a href="#">{!! $date !!}</a></div>
    </div>
    @if ($lengthContent > 0)
        <div class="post_text">
            <p>{!! $content !!}</p>
        </div>
    @endif
</div>
