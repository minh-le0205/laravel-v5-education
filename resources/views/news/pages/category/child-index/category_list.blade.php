<div class="posts">
    @foreach ($item['articles'] as $article)
        <div class="post_item post_h_large">
            <div class="row">
                <div class="col-lg-5">
                    @include('news.partials.article.image', ['item' => $article])
                </div>
                <div class="col-lg-7">
                    @include('news.partials.article.content', [
                        'item' => $article,
                        'lengthContent' => 150,
                        'showCategory' => false,
                    ])
                </div>
            </div>
        </div>
    @endforeach
</div>
