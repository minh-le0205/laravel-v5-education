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
                    <th class="column-title text-center">Link</th>
                    <th class="column-title text-center">Ordering</th>
                    <th class="column-title text-center">Type Menu</th>
                    <th class="column-title text-center">Type Link</th>
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
                            $ordering = $item->ordering;
                            $typeMenu = Template::showItemSelect($controllerName, $id, $item->type_menu, 'type_menu');
                            $typeLink = Template::showItemSelect($controllerName, $id, $item->type_link, 'type_link');
                        @endphp
                        <tr class="{{ $rowClass }} pointer">
                            <td class="text-center">{{ $id }}</td>
                            <td class="text-center">{{ $name }}</td>
                            </td>
                            <td class="text-center">
                                {!! $status !!}
                            </td>
                            <td class="text-center">
                                {!! $link !!}
                            </td>
                            <td class="text-center">
                                {!! $ordering !!}
                            </td>
                            <td>
                                {!! $typeMenu !!}
                            </td>
                            <td>
                                {!! $typeLink !!}
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
