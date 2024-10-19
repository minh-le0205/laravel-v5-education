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
                    <th class="column-title text-center">Thông tin</th>
                    <th class="column-title text-center">Thời gian áp dụng</th>
                    <th class="column-title text-center">Khoảng giá</th>
                    <th class="column-title text-center">Số lượng</th>
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
                            $code = Highlight::show($item['code'], $params['search'], 'code');
                            $type = config('zvn.template.type_discount_coupon.' . $item['type'])['name'];
                            $value = Highlight::show($item['value'], $params['search'], 'value');
                            $startTime = Highlight::show($item['start_time'], $params['search'], 'start_time');
                            $endTime = Highlight::show($item['end_time'], $params['search'], 'end_time');
                            $startPrice = Highlight::show($item['start_price'], $params['search'], 'start_price');
                            $endPrice = Highlight::show($item['end_price'], $params['search'], 'end_price');
                            $total = Highlight::show($item['total'], $params['search'], 'total');
                            $totalUse = Highlight::show($item['total_use'], $params['search'], 'total_use');
                            $listBtn = Template::showButtonAction($controllerName, $id);
                        @endphp
                        <tr class="{{ $rowClass }} pointer">
                            <td class="text-center">{{ $id }}</td>
                            <td style="max-width: 25em;">
                                <p><strong>Code: </strong>{!! $code !!}</p>
                                <p><strong>Hình thức: </strong>{!! $type !!}</p>
                                <p><strong>Giá trị: </strong>{!! $value !!}</p>
                            </td>
                            <td style="max-width: 25em;">
                                <p><strong>Bắt đầu: </strong>{!! $startTime !!}</p>
                                <p><strong>Kết thúc: </strong>{!! $endTime !!}</p>
                            </td>
                            <td style="max-width: 25em;">
                                <p><strong>Từ: </strong>{!! number_format($startPrice) !!}</p>
                                <p><strong>Đến: </strong>{!! number_format($endPrice) !!}</p>
                            </td>
                            <td style="max-width: 25em;">
                                <p><strong>Tổng: </strong>{!! $total !!}</p>
                                <p><strong>Đã sử dụng: </strong>{!! $totalUse !!}</p>
                            </td>
                            <td class="text-center">
                                {!! $status !!}
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
