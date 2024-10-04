@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');

    $elements = [
        [
            'label' => Form::label('', '', $formLabelAttr),
            'element' => Form::textArea('email_bcc', @$item['bcc'], $formInputAttr),
        ],
        [
            'element' => Form::submit('Lưu', ['class' => 'btn btn-success', 'name' => 'email-bcc-task']),
            'type' => 'btn-submit',
        ],
    ];
@endphp
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title', ['title' => 'BCC'])
            <div class="x_content">
                {{ Form::open([
                    'method' => 'POST',
                    'url' => route("$controllerName/email-bcc-setting"),
                    'accept-charset' => 'UTF-8',
                    'class' => 'form-horizontal form-label-left',
                    'id' => 'setting-email-bcc-form',
                ]) }}
                {!! FormTemplate::show($elements) !!}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
