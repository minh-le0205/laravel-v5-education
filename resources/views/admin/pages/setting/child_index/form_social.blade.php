@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');

    $elements = [
        [
            'label' => Form::label('facebook', 'Facebook', $formLabelAttr),
            'element' => Form::textArea('facebook', @$item['facebook'], $formInputAttr),
        ],

        [
            'label' => Form::label('youtube', 'Youtube', $formLabelAttr),
            'element' => Form::textArea('youtube', @$item['youtube'], $formInputAttr),
        ],

        [
            'label' => Form::label('google', 'Google', $formLabelAttr),
            'element' => Form::textArea('google', @$item['google'], $formInputAttr),
        ],

        [
            'element' => Form::submit('Lưu', ['class' => 'btn btn-success', 'name' => 'social-task']),
            'type' => 'btn-submit',
        ],
    ];
@endphp
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title', ['title' => 'Social'])
            <div class="x_content">
                {{ Form::open([
                    'method' => 'POST',
                    'url' => route("$controllerName/social-setting"),
                    'accept-charset' => 'UTF-8',
                    'class' => 'form-horizontal form-label-left',
                    'id' => 'setting-social-form',
                ]) }}
                {!! FormTemplate::show($elements) !!}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
