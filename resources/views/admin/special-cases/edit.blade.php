<x-admin.layout>
    <div class="main-content-wrap">
        <x-admin.page-heading title="إضافة حالة" />

        <!-- form-add-product -->
        <form id="myform" class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
            action="{{ route('admin.special-cases.update', $specialCase) }}">
            @csrf
            @method('Put')

            <div class="wg-box">

                <fieldset class="title">
                    <div class="body-title mb-10">العنوان<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="title" class="mb-10" required :object="$specialCase" />
                </fieldset>


                <fieldset class="name">
                    <div class="body-title mb-10">عمر المريض<span class="tf-color-1">*</span>
                    </div>
                    <x-admin.forms.input name="patient_age" class="mb-10" required :object="$specialCase" />
                </fieldset>

                <fieldset class="name">
                    <div class="body-title mb-10">مدة العلاج <span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="treatment_duration" class="mb-10" required :object="$specialCase" />
                </fieldset>

                <fieldset class="name">
                    <div class="body-title mb-10">الإجراءات<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="procedures" class="mb-10" required :object="$specialCase" />
                </fieldset>

                <div class="gap22 cols">
                    <x-admin.forms.select-field lable="الطبيب" defaultSelection="إختر طبيب" name="doctor_id" required
                        :objects="$doctors" :isEditPage="true" :MianObject="$specialCase" togetFirstIdFrom="doctor" />
                </div>

                <div class="gap22 cols my-5 p-4 border " style="border-radius: 8px">
                    <div class="form-check d-flex align-items-center gap-4">
                        <label class="form-check-label" for="checkChecked" style="font-size: 16px; font-weight: bold;">
                            حالة مميزة
                        </label>
                        <input class="form-check-input " type="checkbox"
                            {{ $specialCase->is_special_case == 1 ? 'checked' : '' }} id="checkChecked"
                            name="is_special_case">
                    </div>
                    <x-admin.forms.error :error="$errors->first('is_special_case')" />
                </div>

                <fieldset class="shortdescription">
                    <div class="body-title mb-10">شرح ملخص<span class="tf-color-1">*</span></div>
                    <textarea class="mb-10 ht-150" name="overview" tabindex="0" aria-required="true" required="">{{ $specialCase->overview }}</textarea>
                    <x-admin.forms.error :error="$errors->first('overview')" />

                </fieldset>

                <fieldset class="description">
                    <div class="body-title mb-10">خطة العلاج<span class="tf-color-1">*</span></div>
                    <textarea name="treatment_plan" class="mb-10 tinymce_textarea" >{{ $specialCase->treatment_plan }}</textarea>
                    <x-admin.forms.error :error="$errors->first('treatment_plan')" />
                </fieldset>

            </div>
            <div class="wg-box">

                <x-admin.forms.upload-file name="before_image" label="Upload Befor image" fieldNumber='1'
                    :value="$specialCase->before_image" />

                <x-admin.forms.upload-file name="after_image" label="Upload After image" fieldNumber='2'
                    :value="$specialCase->after_image" />


                <fieldset class="shortdescription">
                    <div class="body-title mb-10">النتيجة<span class="tf-color-1">*</span></div>
                    <textarea class="mb-10 ht-150" name="result" tabindex="0" aria-required="true" required="">{{ $specialCase->result }}</textarea>
                    <x-admin.forms.error :error="$errors->first('result')" required />
                </fieldset>

                <fieldset class="shortdescription">
                    <div class="body-title mb-10">رأي المريض</div>
                    <textarea class="mb-10 ht-150" name="feedback" tabindex="0" aria-required="true" style="height: 150px !important;">{{ $specialCase->feedback ?? '' }}</textarea>
                    <x-admin.forms.error :error="$errors->first('feedback')" />
                </fieldset>



                <div class="cols gap10">
                    <button class="tf-button w-full" type="submit">تعديل الحالة</button>
                </div>
            </div>
        </form>
    </div>


    @push('scripts')
        {{-- tinyMce editor --}}
        <script src="{{ asset('adminAssets/js/tinymce/tinymce.min.js') }}"></script>
        <script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/6/langs/ar.js"></script>
        <script src="{{ asset('adminAssets/js/tinymce/cofig.js') }}"></script>
    @endpush


</x-admin.layout>
