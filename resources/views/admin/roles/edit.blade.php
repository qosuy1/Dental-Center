<x-admin.layout>
    <div class="main-content-wrap">
        <x-admin.page-heading title="Edit Role" />

        <div class="wg-box">
            <form action="{{ route('admin.roles.update' , $role) }}" method="POST">
                @csrf
                @method('put')
                <fieldset class="name mb-5">
                    <div class="body-title fs-3">Role Name<span class="tf-color-1">*</span></div>
                    <x-admin.forms.input name="name" class="mt-4" :object="$role"/>
                </fieldset>

                <div class="form-group" style="margin-top: 40px">
                    <div class="h4 pb-4 text-primary border-2 border-bottom border-primary d-flex"
                        style="font-size: 20px;">
                        Permissions<span class="tf-color-1">*</span>
                        <div class=" d-flex justify-center align-items-center gap-4 me-5">
                            <input type="checkbox" class="form-check-input" id="select-all-permissions">
                            <label class="form-check-label" for="select-all-permissions">إختيار الكل</label>
                        </div>
                    </div>

                    <div class="permissions-sections mt-5">
                        @php
                            $groupedPermissions = $permissions->groupBy(function ($permission) {
                                return explode(' ', $permission->name)[1];
                            });
                        @endphp

                        @foreach ($groupedPermissions as $section => $perms)
                            <div class="permission-section">
                                <div class="section-header d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input section-checkbox me-2"
                                        id="section_{{ $section }}" data-section="{{ $section }}">
                                    <h4 class="section-title my-1 me-3">{{ ucfirst($section) }}</h4>
                                </div>
                                <div class="permissions-grid">
                                    @foreach ($perms as $permission)
                                        <div class="permission-item">
                                            <input type="checkbox" class="form-check-input permission-checkbox ms-3"
                                                name="permissions[]" value="{{ $permission->id }}"
                                                id="permission_{{ $permission->id }}" data-section="{{ $section }}"
                                                {{ in_array($permission->id, old('permissions', $rolePermissions ?? [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <x-admin.forms.error :error="$errors->first('permissions')" />
                </div>

                <div class="bot my-5 justify-content-end d-flex justify-content-between">
                    <a href="{{route('admin.roles.index')}}" class="tf-button style-1">عودة</a>
                    <button class="tf-button w208" type="submit">تحديث</button>
                </div>
            </form>

        </div>
    </div>

    @push('styles')
        <style>
            .permissions-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1rem;
                padding: 1rem;
                background: var(--bg-table);
                border-radius: 12px;
            }

            .form-check {
                margin-bottom: 0.5rem;
            }

            .form-check-input {
                margin-right: 0.5rem;
            }

            .form-check-label {
                color: var(--Heading);
            }

            .section-header {
                margin-bottom: 1rem;
            }

            .permission-section {
                margin-bottom: 2rem;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Master checkbox functionality
                const selectAllCheckbox = document.getElementById('select-all-permissions');
                const allPermissionCheckboxes = document.querySelectorAll('.permission-checkbox');
                const allSectionCheckboxes = document.querySelectorAll('.section-checkbox');

                selectAllCheckbox.addEventListener('change', function() {
                    const isChecked = this.checked;
                    allPermissionCheckboxes.forEach(checkbox => checkbox.checked = isChecked);
                    allSectionCheckboxes.forEach(checkbox => checkbox.checked = isChecked);
                });

                // Section checkboxes functionality
                allSectionCheckboxes.forEach(sectionCheckbox => {
                    sectionCheckbox.addEventListener('change', function() {
                        const section = this.dataset.section;
                        const isChecked = this.checked;
                        const sectionPermissions = document.querySelectorAll(
                            `.permission-checkbox[data-section="${section}"]`);
                        sectionPermissions.forEach(checkbox => checkbox.checked = isChecked);

                        // Update master checkbox state
                        updateMasterCheckboxState();
                    });
                });

                // Individual permission checkboxes functionality
                allPermissionCheckboxes.forEach(permissionCheckbox => {
                    permissionCheckbox.addEventListener('change', function() {
                        const section = this.dataset.section;
                        const sectionCheckbox = document.querySelector(`#section_${section}`);
                        const sectionPermissions = document.querySelectorAll(
                            `.permission-checkbox[data-section="${section}"]`);
                        const checkedPermissions = document.querySelectorAll(
                            `.permission-checkbox[data-section="${section}"]:checked`);

                        // Update section checkbox state
                        sectionCheckbox.checked = checkedPermissions.length === sectionPermissions
                            .length;

                        // Update master checkbox state
                        updateMasterCheckboxState();
                    });
                });

                // Function to update master checkbox state
                function updateMasterCheckboxState() {
                    const totalPermissions = allPermissionCheckboxes.length;
                    const checkedPermissions = document.querySelectorAll('.permission-checkbox:checked').length;
                    selectAllCheckbox.checked = totalPermissions === checkedPermissions;
                }
            });
        </script>
    @endpush
</x-admin.layout>
