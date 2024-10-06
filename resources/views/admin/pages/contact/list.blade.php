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
                    <th class="column-title text-center">Họ tên</th>
                    <th class="column-title text-center">Email</th>
                    <th class="column-title text-center">Số điện thoại</th>
                    <th class="column-title text-center">IP</th>
                    <th class="column-title text-center">Lời nhắn</th>
                    <th class="column-title text-center">Trạng thái</th>
                    <th class="column-title text-center">Khởi tạo</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                    @foreach ($items as $key => $item)
                        @php
                            $rowClass = $key % 2 == 0 ? 'even' : 'odd';
                            $id = $item->id;
                            $name = Highlight::show($item['full_name'], $params['search'], 'name');
                            $email = Highlight::show($item['email'], $params['search'], 'email');
                            $phone = Highlight::show($item['phone'], $params['search'], 'phone');
                            $ipAddress = Highlight::show($item['ip_address'], $params['search'], 'ip_address');
                            $message = Highlight::show($item['message'], $params['search'], 'message');
                            $hasContacted = Template::showItemHasContacted(
                                $controllerName,
                                $id,
                                $item['has_contacted'],
                            );
                            $created = Highlight::show($item['created'], $params['search'], 'created');
                        @endphp
                        <tr class="{{ $rowClass }} pointer">
                            <td class="text-center">{{ $item->id }}</td>
                            <td class="text-center">{!! $name !!}</td>
                            <td class="text-center">{!! $email !!}</td>
                            <td class="text-center">{!! $phone !!}</td>
                            <td class="text-center">{!! $ipAddress !!}</td>
                            <td class="text-center">{!! $message !!}</td>
                            <td class="text-center">
                                {!! $hasContacted !!}
                            </td>
                            <td class="text-center">
                                {!! $created !!}
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
