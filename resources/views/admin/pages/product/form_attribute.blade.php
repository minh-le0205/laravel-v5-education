@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formLabelAttr = config('zvn.template.form_label');

    $inputHiddenId = Form::hidden('id', $item['id'] ?? '');

    if (count($itemsAttribute) > 0) {
        foreach ($itemsAttribute as $item) {
            $elementsA[] = [
                'label' => Form::label("attribute[$item->id]", $item->name, $formLabelAttr),
                'element' => Form::textArea("attribute[$item->id]", @$item->values, [
                    'class' => 'product-attr-tags form-control col-md-6 col-xs-12',
                    'id' => "attribute-$item->id",
                ]),
            ];
        }
        $elementsA[] = [
            'element' => $inputHiddenId . Form::submit('Save', ['class' => 'btn btn-success']),
            'type' => 'btn-submit',
        ];
    }
@endphp
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title', ['title' => 'Thuộc tính sản phẩm'])
            <div class="x_content">
                {{ Form::open([
                    'method' => 'POST',
                    'url' => route("$controllerName/save_attribute"),
                    'accept-charset' => 'UTF-8',
                    'class' => 'form-horizontal form-label-left',
                    'id' => 'main-form',
                ]) }}
                {!! FormTemplate::show($elementsA) !!}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
