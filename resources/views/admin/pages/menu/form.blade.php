@extends('admin.main')
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;
    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');
    $statusValue = [
        'default' => 'Select status',
        'active' => config('zvn.template.status.active.name'),
        'inactive' => config('zvn.template.status.inactive.name'),
    ];

    $typeMenuValues = array_combine(
        array_keys(config('zvn.template.type_menu')),
        array_column(config('zvn.template.type_menu'), 'name'),
    );

    $typeLinkValues = array_combine(
        array_keys(config('zvn.template.type_link')),
        array_column(config('zvn.template.type_link'), 'name'),
    );

    $inputHiddenId = Form::hidden('id', $item['id'] ?? '');

    $elements = [
        [
            'label' => Form::label('name', 'Name', $formLabelAttr),
            'element' => Form::text('name', $item['name'] ?? '', $formInputAttr),
        ],
        [
            'label' => Form::label('status', 'Status', $formLabelAttr),
            'element' => Form::select('status', $statusValue, @$item['status'], $formInputAttr),
        ],
        [
            'label' => Form::label('link', 'Link', $formLabelAttr),
            'element' => Form::text('link', $item['link'] ?? '', $formInputAttr),
        ],
        [
            'label' => Form::label('ordering', 'Ordering', $formLabelAttr),
            'element' => Form::number('ordering', @$item['ordering'], $formInputAttr),
        ],
        [
            'label' => Form::label('type_menu', 'Type Menu', $formLabelAttr),
            'element' => Form::select('type_menu', $typeMenuValues, @$item['type_menu'], $formInputAttr),
        ],
        [
            'label' => Form::label('type_link', 'Type Link', $formLabelAttr),
            'element' => Form::select('type_link', $typeLinkValues, @$item['type_link'], $formInputAttr),
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
