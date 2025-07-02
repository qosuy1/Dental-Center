<x-admin.layout>

    {{-- @dd($errors) --}}

    <div class="main-content-wrap">
        <form class="tf-section-2 form-add-product" action="{{ route('admin.settings.update', $setting) }}" method="POST"
        enctype="multipart/form-data">
        {{-- @dd($settings); --}}
            @csrf
            @method('put')


            <div class="wg-box">
                <x-admin.page-heading title="الإعدادات العامة" />

                <fieldset class="name">
                    <div class="body-title">الموقع (Location)<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="address" :object="$setting" />
                </fieldset>

                <fieldset class="phone-number">
                    <div class="body-title">رقم المركز<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="number" :object="$setting" />
                </fieldset>


                <fieldset class="facebook">
                    <div class="body-title">facebook<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="facebook" class="form-control" :object="$setting" />
                </fieldset>

                <fieldset class="email">
                    <div class="body-title">email</div>
                    <x-admin.forms.input name="email" class="form-control mb-2" :object="$setting" />
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">instagram</div>
                    <x-admin.forms.input name="instagram" class="form-control mb-2" :object="$setting" />
                </fieldset>
                <fieldset class="name">
                    <div class="body-title">linkedin</div>
                    <x-admin.forms.input name="linkedin" class="form-control mb-2" :object="$setting" />
                </fieldset>


                {{-- <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Update</button>
                    </div> --}}
            </div>



            <div class="wg-box">

                <x-admin.page-heading title="لصفحة ال About us" />


                <fieldset class="name">
                    <div class="body-title">الموقع على خريطة جوجل<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="google_map_location" :object="$setting"
                        value="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d404.32575089451785!2d36.56873832437571!3d32.712720588701224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151bd5fcce7fad77%3A0x69d3109244f6e114!2sCity%20Smiles%20Dental%20Clinic!5e1!3m2!1sar!2s!4v1745025536020!5m2!1sar!2s" />
                </fieldset>

                <fieldset class="phone-number">
                    <div class="body-title">Our Story <span class="tf-color-1">*</span></div>
                    <textarea name="our_story" class="mb-10 border-3" style="height: 200px !important ; direction: ltr;">{{ old('our_story', $setting->our_story ?? "") }}</textarea>
                    <x-admin.forms.error :error="$errors->first('our_story')" />
                </fieldset>


                <x-admin.forms.upload-file name="about_us_image" label="أرفع صورة لصفحة ال About" :value="$setting->about_us_image ?? null" />



                <div class="bot">
                    <button class="tf-button w208" type="submit">Update</button>
                </div>
            </div>

        </form>

    </div>

</x-admin.layout>
