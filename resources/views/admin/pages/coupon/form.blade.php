@extends('admin.main')
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;
    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');
    $statusValue = [
        'default' => 'Chọn trạng thái',
        'active' => config('zvn.template.status.active.name'),
        'inactive' => config('zvn.template.status.inactive.name'),
    ];

    $typeValues = [
        'default' => 'Chọn loại giảm giá',
    ];
    $typeValues = array_merge(
        $typeValues,
        array_combine(
            array_keys(config('zvn.template.type_discount_coupon')),
            array_column(config('zvn.template.type_discount_coupon'), 'name'),
        ),
    );

    $inputHiddenId = Form::hidden('id', $item['id'] ?? '');

    if (isset($item['id'])) {
        $code = Form::text('code_edit', $item['code'] ?? '', $formInputAttr + ['readonly' => true]);
    } else {
        $code = sprintf(
            '<div class="col-lg-8">%s</div><div class="col-lg-4">%s</div>',
            Form::text('code', Str::random(6), $formInputAttr),
            Form::button('Tạo lại mã', [
                'class' => 'btn btn-block btn-success',
                'id' => 'btn-generate-coupon',
                'type' => 'button',
            ]),
        );
    }

    $startTime = isset($item['start_time']) ? date('d/m/Y H:i:s', strtotime($item['start_time'])) : date('d/m/Y H:i:s');
    $endTime = isset($item['end_time']) ? date('d/m/Y H:i:s', strtotime($item['end_time'])) : date('d/m/Y H:i:s');

    $elements = [
        [
            'label' => Form::label('code', 'Mã giảm giá', $formLabelAttr),
            'element' => $code,
        ],
        [
            'label' => Form::label('type', 'Loại giảm giá', $formLabelAttr),
            'element' => Form::select('type', $typeValues, @$item['type'], $formInputAttr),
        ],
        [
            'label' => Form::label('value', 'Giá trị', $formLabelAttr),
            'element' => Form::text('value', $item['value'] ?? '', $formInputAttr),
        ],
        [
            'label' => Form::label('datepicker-coupon', 'Thời gian áp dụng', $formLabelAttr),
            'element' =>
                Form::text(
                    'datepicker-coupon',
                    null,
                    $formInputAttr + ['data-start' => $startTime, 'data-end' => $endTime],
                ) .
                Form::hidden('start_time', $item['start_time'] ?? date('Y-m-d H:i:s')) .
                Form::hidden('end_time', $item['end_time'] ?? date('Y-m-d H:i:s')),
        ],
        [
            'label' => Form::label('start__end_price', 'Khoảng giá áp dụng', $formLabelAttr),
            'element' => sprintf(
                '
              <div style="margin-left:-10px" class="col-md-6">%s</div><div class="col-md-6">%s</div>
              ',
                Form::number('start_price', $item['start_price'] ?? '', $formInputAttr + ['placeholder' => 'Từ']),
                Form::number('end_price', $item['end_price'] ?? '', $formInputAttr + ['placeholder' => 'Đến']),
            ),
        ],
        [
            'label' => Form::label('total', 'Số lượng', $formLabelAttr),
            'element' => Form::text('total', $item['total'] ?? '', $formInputAttr),
        ],
        [
            'label' => Form::label('status', 'Trạng thái', $formLabelAttr),
            'element' => Form::select('status', $statusValue, @$item['status'], $formInputAttr),
        ],
        [
            'element' => $inputHiddenId . Form::submit('Save', ['class' => 'btn btn-success']),
            'type' => 'btn-submit',
        ],
    ];
@endphp
@section('content')
    @include('admin.templates.page_header', ['pageIndex' => false])
    @include('admin.templates.zvn_notify')
    @include('admin.templates.error')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Form'])
                <div class="x_content">
                    {!! Form::open([
                        'method' => 'POST',
                        'url' => route("$controllerName/save"),
                        'enctype' => 'multipart/form-data',
                        'class' => 'form-horizontal form-label-left',
                        'id' => 'main-form',
                        'accept-charset' => 'UTF-8',
                    ]) !!}
                    {!! FormTemplate::show($elements) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
