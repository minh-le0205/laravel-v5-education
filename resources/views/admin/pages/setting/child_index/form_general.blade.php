@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');
    $formCkEditor = config('zvn.template.form_ckeditor');

    $logo = $item['logo'] ?? '';
    $logoElement = sprintf(
        '
        <div class="input-group">
   <span class="input-group-btn">
     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
       <i class="fa fa-picture-o"></i> Choose
     </a>
   </span>
   <input id="thumbnail" class="form-control" type="text" name="logo" value="%s">
 </div>
 <img id="holder" style="margin-top:15px;max-height:100px;" src="%s">
    ',
        $logo,
        asset($logo),
    );

    $elements = [
        [
            'label' => Form::label('logo', 'Logo', $formLabelAttr),
            'element' => $logoElement,
        ],
        [
            'label' => Form::label('hotline', 'Hotline', $formLabelAttr),
            'element' => Form::text('hotline', @$item['hotline'], $formInputAttr),
        ],
        [
            'label' => Form::label('working_tinme', 'Thời gian làm việc', $formLabelAttr),
            'element' => Form::text('working_tinme', @$item['working_tinme'], $formInputAttr),
        ],

        [
            'label' => Form::label('copyright', 'Copyright', $formLabelAttr),
            'element' => Form::text('copyright', @$item['copyright'], $formInputAttr),
        ],

        [
            'label' => Form::label('address', 'Địa chỉ', $formLabelAttr),
            'element' => Form::text('address', @$item['address'], $formInputAttr),
        ],
        [
            'label' => Form::label('introduce', 'Giới thiệu', $formLabelAttr),
            'element' => Form::textArea('introduce', $item['introduce'] ?? '', $formCkEditor),
        ],
        [
            'label' => Form::label('maps', 'Google map', $formLabelAttr),
            'element' => Form::textArea('maps', @$item['maps'], $formInputAttr),
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
            @include('admin.templates.x_title', ['title' => 'Cấu hình chung'])
            <div class="x_content">
                {{ Form::open([
                    'method' => 'POST',
                    'url' => route("$controllerName/general-setting"),
                    'accept-charset' => 'UTF-8',
                    'enctype' => 'multipart/form-data',
                    'class' => 'form-horizontal form-label-left',
                    'id' => 'setting-general-form',
                ]) }}
                {!! FormTemplate::show($elements) !!}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
