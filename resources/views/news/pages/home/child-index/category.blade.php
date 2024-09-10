@foreach ($itemsCategory as $item)
    @if ($item['display'] == 'list')
        @include('news.pages.home.child-index.category_list', ['name' => $item['name']])
    @else
        @include('news.pages.home.child-index.category_grid', ['name' => $item['name']])
    @endif
@endforeach