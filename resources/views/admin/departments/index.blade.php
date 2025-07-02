@php
    use App\Enum\PermissionsEnum;
@endphp

<x-admin.layout>

    <div class="main-content-wrap">
        <x-admin.page-heading title="الأقسام" />

        <div class="wg-box">

            <x-admin.search-bar-add-button placeholder="(إسم القسم)" :create_route="route('admin.departments.create')" :can="PermissionsEnum::create_department->value"
                :searchBar="false" />

            <div class="wg-table ">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:15%">ID</th>
                                <th>إسم القسم</th>
                                <th colspan="2">الخدمات</th>
                                <th>عدد الأطباء في القسم</th>
                                <th style="width:15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($departments as $department)
                                <tr>
                                    <td>{{ $department->id }}</td>
                                    <td class="pname">
                                        <div class="name">
                                            <a href="#" class="body-title-2">{{ $department->name }}</a>
                                        </div>
                                    </td>
                                    <td colspan="2">
                                        @foreach ($department->services->all() as $service)
                                            <span class="badge bg-info fs-6">{{ $service->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $department->doctors->count() }}</td>
                                    <td>
                                        <div class="list-icon-function gap-5">
                                            @can(PermissionsEnum::edit_department)
                                                <x-admin.forms.edit-form-button stringRoute="admin.departments.edit"
                                                    :parameter="$department" />
                                            @endcan

                                            @can(PermissionsEnum::delete_department)
                                                <x-admin.forms.delete-form-button stringRoute="admin.departments.destroy"
                                                    :parameter="$department" />
                                            @endcan

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center h6 p-2 my-4 text-danger">لا توجداقسام
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="divider"></div>
            {{-- <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
            </div> --}}
            <x-admin.pagination :attribute="$departments" />
        </div>
    </div>

    @push('styles')
        <style>
            .permissions-list {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .badge {
                font-size: 0.8rem;
                padding: 0.35em 0.65em;
            }

            .list-icon-function {
                display: flex;
                gap: 1rem;
                justify-content: center;
            }

            .btn-sm {
                padding: 0.25rem 0.5rem;
            }
        </style>
    @endpush

</x-admin.layout>
