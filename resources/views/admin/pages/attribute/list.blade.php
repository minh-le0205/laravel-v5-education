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
                    <th class="column-title text-center">Name</th>
                    <th class="column-title text-center">Status</th>
                    <th class="column-title text-center">Ordering</th>
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
                            $listBtn = Template::showButtonAction($controllerName, $id);
                            $link = $item->link;
                            $ordering = Template::showItemOrdering($controllerName, $item->ordering, $id);
                        @endphp
                        <tr class="{{ $rowClass }} pointer">
                            <td class="text-center">{{ $id }}</td>
                            <td class="text-center">{{ $name }}</td>
                            </td>
                            <td class="text-center">
                                {!! $status !!}
                            </td>
                            <td class="text-center">
                                {!! $ordering !!}
                            </td>
                            <td class="text-center">
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
