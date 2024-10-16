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
                    <th class="column-title text-center">Category</th>
                    <th class="column-title text-center">Trạng thái</th>
                    <th class="column-title text-center">Ordering</th>
                    <th class="column-title text-center">Hiển thị home</th>
                    <th class="column-title text-center">Kiểu hiển thị</th>
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
                            $isHome = null;
                            if (!is_null($item->is_home)) {
                                $isHome = Template::showItemIsHome($controllerName, $id, $item->is_home);
                            }
                            $display = Template::showItemSelect($controllerName, $id, $item->display, 'display');
                            $name = Template::showNestedSetName($item->name, $item->depth);
                            $createdHistory = Template::showItemHistory($item->created_by, $item->created);
                            $modifiedHistory = Template::showItemHistory($item->modified_by, $item->modified);
                            $listBtn = Template::showButtonAction($controllerName, $id);
                            $move = Template::showNestedSetUpDown($controllerName, $id);
                        @endphp
                        <tr class="{{ $rowClass }} pointer">
                            <td class="text-center">{{ $item->id }}</td>
                            <td>{!! $name !!}</td>
                            <td class="text-center">
                                {!! $status !!}
                            </td>
                            <td class="text-center">
                                {!! $move !!}
                            </td>
                            <td class="text-center">
                                {!! $isHome !!}
                            </td>
                            <td class="text-center">
                                {!! $display !!}
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
