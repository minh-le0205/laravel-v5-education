@extends('admin.main')
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');

    $elements = [
        [
            'label' => Form::label('value', 'Link', $formLabelAttr),
            'element' => Form::text('value', @$item['value'], $formInputAttr),
        ],

        [
            'element' => Form::submit('Lưu', ['class' => 'btn btn-success']),
            'type' => 'btn-submit',
        ],
    ];
@endphp
@section('content')
    @include('admin.templates.page_header', ['pageIndex' => false])
    @include('admin.templates.zvn_notify')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Link playlist youtube'])
                <div class="x_content">
                    {{ Form::open([
                        'method' => 'POST',
                        'url' => route("$controllerName/save"),
                        'accept-charset' => 'UTF-8',
                        'class' => 'form-horizontal form-label-left',
                        'id' => 'setting-email-account-form',
                    ]) }}
                    {!! FormTemplate::show($elements) !!}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Danh sách'])
                @include('admin.pages.video.list', ['item' => $item])
            </div>
        </div>
    </div>
@endsection
