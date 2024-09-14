@if (!empty($item['related_articles']))
    <div class="section_title_container d-flex flex-row align-items-start justify-content-start zvn-title-category">
        <div>
            <div class="section_title">Bài viết liên quan</div>
        </div>
        <div class="section_bar"></div>
    </div>
    @if ($item['display'] == 'list')
        @include('news.pages.article.child-index.category_list')
    @else
        @include('news.pages.article.child-index.category_grid')
    @endif
@endif
