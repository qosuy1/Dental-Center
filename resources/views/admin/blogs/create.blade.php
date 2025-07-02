<x-admin.layout>

    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>إضافة مقال</h3>
        </div>
        <!-- new-blogs -->
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{ route('admin.blogs.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <x-admin.forms.upload-file name="image" />


                <x-admin.forms.select-field lable="الطبيب الناشر" defaultSelection="إختر الطبيب" name="doctor_id"
                    :objects="$doctors" style="width: 330.5px" />

                <fieldset class="name">
                    <div class="body-title">العنوان<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="title" />
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">شرح توضيحي<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="smallDesc" />
                </fieldset>

                <fieldset class="description">
                    <div class="body-title">المحتوى <span class="tf-color-1">*</span></div>
                    <textarea name="content" class="mb-10 tinymce_textarea" value="" aria-required="true">{{ old('content') }}</textarea>
                    <x-admin.forms.error :error="$errors->first('content')" />
                </fieldset>

                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">نشر</button>
                </div>
            </form>|
        </div>
    </div>


    @push('scripts')
        {{-- tinyMce editor --}}
        <script src="{{ asset('adminAssets/js/tinymce/tinymce.min.js') }}"></script>
        <script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/6/langs/ar.js"></script>
        <script src="{{ asset('adminAssets/js/tinymce/cofig.js') }}"></script>
    @endpush

</x-admin.layout>
