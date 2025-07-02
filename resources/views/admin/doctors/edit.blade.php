<x-admin.layout>

    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>تعديل طبيب</h3>
        </div>

        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{ route('admin.doctors.update', $doctor) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <x-admin.forms.upload-file name="image" label="أرفع صورة الطبيب" :value="old('image', $doctor->image ?? null)" />

                <fieldset class="name">
                    <div class="body-title">أسم الطبيب<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="name" :object="$doctor" />
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">الخبرة<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="experince" :object="$doctor" />
                </fieldset>

                {{-- <fieldset class="Department">
                    <div class="body-title mb-10">القسم <span class="tf-color-1">*</span>
                    </div>
                    <div class="select">
                        <select class="" name="department_id" style="width: 235.5px">
                            <option value="{{ $doctor->department_id }}">{{ $doctor->department->title }}</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ $department->id == $doctor->department->first()->id ? 'selected' : '' }}>
                                    {{ $department->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-admin.forms.error :error="$errors->first('department_id')" />
                </fieldset> --}}

                <x-admin.forms.select-field style="width: 235.5px" lable="القسم" name="department_id"
                    defaultSelection="إختر قسم" :objects="$departments" :isEditPage="true" :MianObject="$doctor"
                    togetFirstIdFrom="department" />


                <fieldset class="phone">
                    <div class="body-title">الهاتف<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="phone" class="form-control" :object="$doctor" />
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">email</div>
                    <x-admin.forms.input name="email" class="form-control mb-2" :object="$doctor" />
                </fieldset>

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
                        <x-admin.forms.input name="facebook" class="form-control mb-2" id="input1" disabled
                            :object="$doctor" />
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">linkedin</div>
                        <x-admin.forms.input name="linkedin" class="form-control mb-2" id="input2" disabled
                            :object="$doctor" />
                    </fieldset>

                </div>


                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

</x-admin.layout>
