<x-admin.layout>

    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>إضافة مستخدم</h3>
        </div>
        <!-- new-category -->
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{ route('admin.users.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <fieldset class="name">
                    <div class="body-title">أسم المستخدم<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="name" />
                </fieldset>

                <fieldset class="email">
                    <div class="body-title">البريد الإلكتروني<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="email" />
                </fieldset>

                <fieldset class="password">
                    <div class="body-title">كلمة المرور<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="password" type="password" />
                </fieldset>

                <fieldset class="password_confirmation">
                    <div class="body-title">تأكيد كلمة المرور<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="password_confirmation" type="password" />
                </fieldset>

                <fieldset class="role">
                    <div class="body-title mb-10">الصلاحية <span class="tf-color-1">*</span>
                    </div>
                    <div class="select">
                        <select class="" name="role_id" style="width: 235.5px">
                            <option value="{{ old('role_id') }}">إختر صلاحية</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-admin.forms.error :error="$errors->first('role_id')" />
                </fieldset>

                <div class="form-check mt-5">
                    <div class="body-title mb-10">الحالة <span class="tf-color-1">*</span></div>

                    <div class="ms-5 d-flex align-items-center gap-3">
                        <input type="radio" class="" name="status" value="active"
                            {{ old('status', 'active') == 'active' ? 'checked' : '' }} id="status-active">

                        <label class="form-check-label" for="status-active">مفعل</label>
                    </div>
                    <div class="d-flex align-items-center gap-3">

                        <input type="radio" class="" name="status" value="unactive"
                            {{ old('status') == 'unactive' ? 'checked' : '' }} id="status-unactive">

                        <label class="form-check-label" for="status-unactive">غير مفعل</label>
                    </div>

                </div>

                <div class="bot my-5 justify-content-end">
                    <button class="tf-button w208" type="submit">إضافة</button>
                </div>
            </form>
        </div>
    </div>

</x-admin.layout>
