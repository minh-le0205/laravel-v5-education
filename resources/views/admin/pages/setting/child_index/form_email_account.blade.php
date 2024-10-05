@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');

    $elements = [
        [
            'label' => Form::label('email_account_username', 'Tài khoản', $formLabelAttr),
            'element' => Form::text('email_account_username', @$item['email_account_username'], $formInputAttr),
        ],
        [
            'label' => Form::label('email_account_password', 'Mật khẩu', $formLabelAttr),
            'element' => Form::text('email_account_password', @$item['email_account_password'], $formInputAttr),
        ],

        [
            'element' => Form::submit('Lưu', ['class' => 'btn btn-success']),
            'type' => 'btn-submit',
        ],
    ];
@endphp
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title', ['title' => 'Tài khoản'])
            <div class="x_content">
                {{ Form::open([
                    'method' => 'POST',
                    'url' => route("$controllerName/email-account-setting"),
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
