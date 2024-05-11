<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">ID</th>
                    <th class="column-title">Slider Info</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Tạo mới</th>
                    <th class="column-title">Chỉnh sửa</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                    @foreach ($items as $item)
                        <tr class="even pointer">
                            <td class="">{{ $item->id }}</td>
                            <td class="">{{ $item->name }}</td>
                            </td>
                            <td><a href="/change-status-active/{{ $item->id }}" type="button"
                                    class="btn btn-round btn-success">{{ $item->status }}</a>
                            </td>
                            <td>
                                <p><i class="fa fa-user"></i> {{ $item->created_by }}</p>
                                <p><i class="fa fa-clock-o"></i> {{ $item->created }}</p>
                            </td>
                            <td>
                                <p><i class="fa fa-user"></i> {{ $item->modified_by }}</p>
                                <p><i class="fa fa-clock-o"></i> {{ $item->modified }}</p>
                            </td>
                            <td class="last">
                                <div class="zvn-box-btn-filter"><a href="/form/{{ $item->id }}" type="button"
                                        class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a><a href="/delete/{{ $item->id }}" type="button"
                                        class="btn btn-icon btn-danger btn-delete" data-toggle="tooltip"
                                        data-placement="top" data-original-title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">
                            No Data
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
