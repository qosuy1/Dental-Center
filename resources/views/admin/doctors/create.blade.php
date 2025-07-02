<x-admin.layout>

    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>إضافة طبيب</h3>
        </div>

        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{ route('admin.doctors.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <x-admin.forms.upload-file name="image" label="أرفع صورة الطبيب" />

                <fieldset class="name">
                    <div class="body-title">أسم الطبيب<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="name" />
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">الخبرة<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="experince" />
                </fieldset>

                {{-- <fieldset class="Department">
                    <div class="body-title mb-10">القسم <span class="tf-color-1">*</span>
                    </div>
                    <div class="select">
                        <select class="" name="department_id" style="width: 235.5px">
                            <option value="{{ old('department_id') }}">إختر قسم</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-admin.forms.error :error="$errors->first('department_id')" />
                </fieldset> --}}

                <x-admin.forms.select-field style="width: 330.5px" lable="القسم" name="department_id" defaultSelection="إختر القسم"
                    name="department_id" :objects="$departments" />


                <fieldset class="phone">
                    <div class="body-title">الهاتف<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="phone" class="form-control" />
                </fieldset>
                <fieldset class="email">
                    <div class="body-title">email<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="email" class="form-control mb-2"  />
                </fieldset>

                {{-- socailMedia accounts --}}
                <div class="my-5">
                    <!-- Switch Button -->
                    <div
                        class="form-check form-switch d-flex align-items-center justify-content-between flex-wrap-reverse border border-2 border-info-subtle p-2 ">
                        <input class="form-check-input" type="checkbox" id="toggleSwitch">
                        <label class="form-check-label body-title" for="toggleSwitch">Enable Socail Media
                            Accounts</label>
                    </div>

                    <!-- Input Fields -->
                    <fieldset class="name">
                        <div class="body-title">facebook</div>
                        <x-admin.forms.input name="facebook" class="form-control mb-2" id="input1" disabled />
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">linkedin</div>
                        <x-admin.forms.input name="linkedin" class="form-control mb-2" id="input2" disabled />
                    </fieldset>

                </div>


                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Add</button>
                </div>
            </form>
        </div>
    </div>

</x-admin.layout>
