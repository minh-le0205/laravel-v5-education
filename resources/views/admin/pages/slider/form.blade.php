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

    $inputHiddenId = Form::hidden('id', $item['id'] ?? '');
    $inputHiddenThumb = Form::hidden('thumb_current', $item['thumb'] ?? '');

    $elements = [
        [
            'label' => Form::label('name', 'Name', $formLabelAttr),
            'element' => Form::text('name', $item['name'] ?? '', $formInputAttr),
        ],
        [
            'label' => Form::label('description', 'Description', $formLabelAttr),
            'element' => Form::text('description', $item['description'] ?? '', $formInputAttr),
        ],
        [
            'label' => Form::label('status', 'Status', $formLabelAttr),
            'element' => Form::select('status', $statusValue, $item['status'] ?? '', $formInputAttr),
        ],
        [
            'label' => Form::label('link', 'Link', $formLabelAttr),
            'element' => Form::text('link', $item['link'] ?? '', $formInputAttr),
        ],
        [
            'label' => Form::label('thumb', 'Thumb', $formLabelAttr),
            'element' => Form::file('thumb', $formInputAttr),
            'thumb' => !empty($item['id'])
                ? Template::showItemThumb($controllerName, $item['thumb'], $item['name'])
                : null,
            'type' => 'thumb',
        ],
        [
            'element' => $inputHiddenId . $inputHiddenThumb . Form::submit('Save', ['class' => 'btn btn-success']),
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
