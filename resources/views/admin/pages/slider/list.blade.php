<div class="x_content">
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
                    @foreach ($items as $item)
                        <tr class="even pointer">
                            <td class="text-center">{{ $item->id }}</td>
                            <td style="max-width: 25em;">
                                <p><strong>Name: </strong>{{ $item->name }}</p>
                                <p><strong>Description: </strong>{{ $item->description }}</p>
                                <p><strong>Link: </strong>{{ $item->link }}</p>
                            </td>
                            <td class="text-center" style="max-width: 25em;">
                                <img style="vertical-align: bottom;" width="100%" height="100%"
                                    src="{{ asset("admin/images/sliders/$item->thumb") }}" alt="">
                            </td>
                            </td>
                            <td class="text-center"><a href="/change-status-active/{{ $item->id }}" type="button"
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
                    @include('admin.templates.list_empty', ['colspans' => 6])
                @endif
            </tbody>
        </table>
    </div>
</div>
