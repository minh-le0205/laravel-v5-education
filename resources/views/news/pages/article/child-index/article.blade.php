@include('news.partials.article.image', ['item' => $item])
@include('news.partials.article.content', [
    'item' => $item,
    'lengthContent' => 'full',
    'showCategory' => true,
])
