 @if ($item['display'] == 'list')
     @include('news.pages.category.child-index.category_list', ['name' => $item['name']])
 @else
     @include('news.pages.category.child-index.category_grid', ['name' => $item['name']])
 @endif
