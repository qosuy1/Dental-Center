<x-admin.layout>

    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>تعديل قسم</h3>
        </div>
        <!-- new-category -->
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{ route('admin.departments.update', $department) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <fieldset class="name">
                    <div class="body-title">العنوان<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="name" :object="$department" />
                </fieldset>


                <fieldset class="description">
                    <div class="body-title">الوصف<span class="tf-color-1">*</span></div>
                    <textarea name="smallDesc" class="mb-10 border-3" value="" aria-required="true">{{ old('smallDesc', $department->smallDesc) }}</textarea>
                    <x-admin.forms.error :error="$errors->first('smallDesc')" />
                </fieldset>


                <fieldset class="services">
                    <div class="body-title">خدمات القسم
                        <q class="text-primary">( أفصل بين الخدمات ب "<span class="fs-2"> - </span> " )</q>
                        <span class="tf-color-1">*</span>
                    </div>
                    <textarea name="services" class="mb-10 border-3" placeholder="الخدمة : وصف الخدمة (إن وجد إختياري ) - خدمة أخرى">{{ old('services', $stringServices ) }}</textarea>
                    <x-admin.forms.error :error="$errors->first('services')" />
                </fieldset>

                <div class="bot justify-content-end">
                    <div></div>
                    <button class="tf-button w208" type="submit">تعديل</button>
                </div>
            </form>
        </div>
    </div>

</x-admin.layout>
