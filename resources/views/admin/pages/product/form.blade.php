@extends('admin.main')
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;
    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');
    $formCkEditor = config('zvn.template.form_ckeditor');

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
            'element' => Form::textArea('description', $item['description'] ?? '', $formCkEditor),
        ],
        [
            'label' => Form::label('content', 'Content', $formLabelAttr),
            'element' => Form::textArea('content', $item['content'] ?? '', $formCkEditor),
        ],
        [
            'label' => Form::label('status', 'Status', $formLabelAttr),
            'element' => Form::select('status', $statusValue, $item['status'] ?? '', $formInputAttr),
        ],
        [
            'label' => Form::label('category_id', 'Category', $formLabelAttr),
            'element' => Form::select('category_id', $itemsCategory, $item['category_id'] ?? '', $formInputAttr),
        ],
        [
            'label' => Form::label('price', 'Price', $formLabelAttr),
            'element' => Form::text('price', $item['price'] ?? '', $formInputAttr),
        ],
        [
            'label' => Form::label('thumb', 'Thumb', $formLabelAttr),
            'type' => 'dropzone',
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
                    <div id="tpl" style="display: none">
                        {{-- <div class="dz-preview-dz-file-preview">
                            <div class="dz-image" style="margin: auto">
                                <img data-dz-thumbnail />
                            </div>
                            <div class="dz-details">
                                <div class="dz-filename">
                                    <span data-dz-name></span>
                                </div>
                                <div class="dz-size" data-dz-size></div>
                            </div>
                            <div class="dz-progress">
                                <span class="dz-upload" data-dz-uploadprogress></span>
                            </div>
                            <div class="dz-error-message">
                                <span data-dz-errormessage></span>
                            </div>
                            <div style="margin-top: 5px" class="input-thumb">
                                <input type="text" placeholder="Alt ảnh" name="thumb [alt][]" class="dz-custom-input">
                            </div>
                        </div> --}}
                        <div class="dz-preview dz-file-preview">
                            <div class="dz-details">
                                <div class="dz-filename"><span data-dz-name></span></div>
                                <div class="dz-size" data-dz-size></div>
                                <img data-dz-thumbnail />
                            </div>
                            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                            <div class="dz-success-mark"><span>✔</span></div>
                            <div class="dz-error-mark"><span>✘</span></div>
                            <div class="dz-error-message"><span data-dz-errormessage></span></div>
                            <div style="margin-top: 5px" class="input-thumb">
                                <input type="text" placeholder="Alt ảnh" name="thumb [alt][]" class="dz-custom-input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($item['id']))
                @include('admin.pages.product.form_attribute')
            @endif
        </div>
    </div>
@endsection


{{-- Dropzone script --}}
@section('after_script')
    <script>
        $(document).ready(function() {
            $('#dropzone').sortable({});
            let uploadedDocumentMap = {};
            Dropzone.options.dropzone = {
                dictDefaultMessage: "Kéo thả hình ảnh vào để tải lên",
                dictRemoveFile: "Xóa",
                url: "{{ route('product/media') }}",
                acceptedFiles: ".jpeg, .jpg, .png, .gif",
                addRemoveLinks: true,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                previewTemplate: document.querySelector('#tpl').innerHTML,
                success: function(file, response) {
                    $(file.previewElement)
                        .find('.input-thumb')
                        .append(`<input type="hidden" name="thumb[name][]" value="${response.name}">`);
                    uploadedDocumentMap[file.name] = response.name;
                },
                removedfile: function(file) {
                    file.previewElement.remove();
                    var name = "";
                    if (typeof file.name !== 'undefined') {
                        name = file.name;
                    } else {
                        name = uploadedDocumentMap[file.name];
                    }
                },
                error: function(tile, response) {
                    return false;
                },
            };
        });
    </script>
@endsection
