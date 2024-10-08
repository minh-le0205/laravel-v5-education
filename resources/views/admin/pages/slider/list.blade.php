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
                    <th class="column-title text-center">Slider Info</th>
                    <th class="column-title text-center">Image</th>
                    <th class="column-title text-center">Trạng thái</th>
                    <th class="column-title text-center">Tạo mới</th>
                    <th class="column-title text-center">Chỉnh sửa</th>
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
                            $description = Highlight::show($item['description'], $params['search'], 'description');
                            $link = Highlight::show($item['link'], $params['search'], 'link');
                            $thumb = Template::showItemThumb($controllerName, $item->thumb, $item->name);
                            $createdHistory = Template::showItemHistory($item->created_by, $item->created);
                            $modifiedHistory = Template::showItemHistory($item->modified_by, $item->modified);
                            $listBtn = Template::showButtonAction($controllerName, $id);
                        @endphp
                        <tr class="{{ $rowClass }} pointer">
                            <td class="text-center">{{ $item->id }}</td>
                            <td style="max-width: 25em;">
                                <p><strong>Name: </strong>{!! $name !!}</p>
                                <p><strong>Description: </strong>{!! $description !!}</p>
                                <p><strong>Link: </strong>{!! $link !!}</p>
                            </td>
                            <td class="text-center" style="max-width: 25em;">
                                {!! $thumb !!}
                            </td>
                            </td>
                            <td class="text-center">
                                {!! $status !!}
                            </td>
                            <td>
                                {!! $createdHistory !!}
                            </td>
                            <td>
                                {!! $modifiedHistory !!}
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
