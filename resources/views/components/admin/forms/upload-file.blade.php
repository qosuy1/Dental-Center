{{-- @props(['name' => 'image', 'title' => 'إرفع صورة', 'id_number' => '1'])

<fieldset>
    <div class="body-title">{{ $title }}</div>
    <div class="upload-image flex-grow">
        <div id="upload-file" class="item up-load">
            <label class="uploadfile" for="myFile{{ $id_number }}">
                <span class="icon">
                    <i class="icon-upload-cloud"></i>
                </span>
                <span id="upload-text" class="body-text">Drop your image here or select <span class="tf-color">click to
                        browse</span></span>
                <input type="file" id="myFile{{ $id_number }}" name="{{ $name }}" value=""
                    accept="image/*" onchange='previewFile("{{$id_number}}")'>
            </label>
            <div id="file-preview" style="display: none; margin-top: 15px;">
                <img id="preview-image{{ $id_number }}" src="#" alt="Preview"
                    style="max-width: 200px; max-height: 200px; display: none;">
                <div id="file-info" style="margin-top: 10px;"></div>
            </div>
        </div>
    </div>
</fieldset> --}}




@props([
    'name' => 'image',
    'label' => 'إرفع صورة',
    'value' => old($name),
    'fieldNumber' => '',
    'errors' => $errors,
])


<fieldset>
    <div class="body-title">{{ $label }}</div>
    <div class="upload-image flex-grow">
        <div class="item up-load" id="upload-container-{{ $fieldNumber }}">
            <label class="uploadfile" for="file-{{ $fieldNumber }}">
                <span class="icon">
                    <i class="icon-upload-cloud"></i>
                </span>
                <span id="upload-text-{{ $fieldNumber }}" class="body-text">
                    Drop your image here or select <span class="tf-color">click to browse</span>
                </span>
                <input type="file" id="file-{{ $fieldNumber }}" name="{{ $name }}" accept="image/*"
                    onchange="previewFile('{{ $fieldNumber }}')" {{ $attributes }}
                    @if ($value)
                        value="{{$value}}"
                    @endif
                >

            </label>

            <div id="file-preview-{{ $fieldNumber }}" style="display: block; margin-top: 15px;">
                @if ($value)
                    <img id="preview-image-{{ $fieldNumber }}" src="{{ asset(path:  $value) }}"
                        alt="Preview" style="max-width: 200px; max-height: 200px;">
                @else
                    <img id="preview-image-{{ $fieldNumber }}" src="#" alt="Preview"
                        style="max-width: 200px; max-height: 200px; display: none; ">
                @endif
                <div id="file-info-{{ $fieldNumber }}" style="margin-top: 10px;"></div>
            </div>
        </div>
    </div>
    <x-admin.forms.error :error="$errors->first($name)" />
</fieldset>





{{-- <div id="file-preview-{{ $fieldNumber }}" style="display: none; margin-top: 15px;">
                @if ($value)
                    <img id="preview-image-{{ $fieldNumber }}" src="{{ asset(path: 'storage/' . $value) }}"
                        alt="Preview" style="max-width: 200px; max-height: 200px;">
                @else
                    <img id="preview-image-{{ $fieldNumber }}" src="#" alt="Preview"
                        style="max-width: 200px; max-height: 200px; display: none;">
                @endif
                <div id="file-info-{{ $fieldNumber }}" style="margin-top: 10px;"></div>
            </div> --}}
