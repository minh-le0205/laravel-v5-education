<div class="x_content">
    @php
        use App\Helpers\Template;
        use App\Helpers\Highlight;
    @endphp
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title text-center">ID</th>
                    <th class="column-title text-center">Article Info</th>
                    <th class="column-title text-center">Image</th>
                    <th class="column-title text-center">Category</th>
                    <th class="column-title text-center">Trạng thái</th>
                    <th class="column-title text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                    @foreach ($items as $key => $item)
                        @php
                            $rowClass = $key % 2 == 0 ? 'even' : 'odd';
                            $id = $item->id;
                            $status = Template::showItemStatus($controllerName, $id, $item->status);
                            $name = Highlight::show($item['name'], $params['search'], 'name');
                            $content = Highlight::show($item['content'], $params['search'], 'content');
                            $thumb = Template::showItemThumbNews($controllerName, $item->thumb, $item->name);
                            $category = Form::select('select_change_attr', $itemsCategory, $item->category_id, [
                                'class' => 'form-control',
                                'data-url' => route("$controllerName/change-category", [
                                    'id' => $id,
                                    'category_id' => 'value_new',
                                ]),
                            ]);
                            $listBtn = Template::showButtonAction($controllerName, $id);
                        @endphp
                        <tr class="{{ $rowClass }} pointer">
                            <td class="text-center">{{ $item->id }}</td>
                            <td style="max-width: 25em;">
                                <p><strong>Name: </strong>{!! $name !!}</p>
                                <p><strong>Content: </strong>{!! $content !!}</p>
                            </td>
                            <td class="text-center" style="max-width: 25em;">
                                {!! $thumb !!}
                            </td>
                            </td>
                            <td class="text-center">
                                {!! $category !!}
                            </td>
                            <td class="text-center">
                                {!! $status !!}
                            </td>
                            <td class="last">
                                {!! $listBtn !!}
                            </td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.templates.list_empty', ['colspans' => 6])
                @endif
            </tbody>
        </table>
    </div>
</div>
