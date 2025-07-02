<x-admin.layout>

    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>تعديل مقال</h3>
        </div>
        <!-- new-category -->
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{ route('admin.blogs.update', $blog) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')

                <x-admin.forms.upload-file fieldNumber="1" name="image" :value="old('image', $blog->image ?? null)" />

                <x-admin.forms.select-field lable="الطبيب الناشر" defaultSelection="إختر الطبيب" name="doctor_id"
                    :objects="$doctors"    :isEditPage="true" :MianObject="$blog" togetFirstIdFrom="doctor" />

                <fieldset class="name">
                    <div class="body-title">العنوان<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="title" :object="$blog" />
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">شرح توضيحي<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="smallDesc" :object="$blog" />
                </fieldset>

                <fieldset class="description">
                    <div class="body-title">المحتوى <span class="tf-color-1">*</span></div>
                    <textarea name="content" class="mb-10 tinymce_textarea" aria-required="true">
                        {{ $blog->content }}</textarea>
                    <x-admin.forms.error :error="$errors->first('content')" />
                </fieldset>

                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">نشر</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        {{-- tinyMce editor --}}
        <script src="{{ asset('adminAssets/js/tinymce/tinymce.min.js') }}"></script>
        <script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/6/langs/ar.js"></script>
        <script src="{{ asset('adminAssets/js/tinymce/cofig.js') }}"></script>
    @endpush

</x-admin.layout>
