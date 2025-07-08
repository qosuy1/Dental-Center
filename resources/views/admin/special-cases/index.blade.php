@php
    use App\Enum\PermissionsEnum;
@endphp

<x-admin.layout>
    <div class="main-content-wrap">
        <x-admin.page-heading title="الحالات الخاصة" />

        <div class="wg-box">
            <x-admin.search-bar-add-button placeholder="(اسم الحالة)" :create_route="route('admin.special-cases.create')" :can="PermissionsEnum::create_case->value">

                <x-slot name="dropdownMenu">
                    <div class="dropdown">
                        <button class="tf-button style-1 w2 dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            الحالة
                        </button>
                        <ul class="dropdown-menu fs-4">
                            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(query: ['casesType'=>'allCases']) }}">
                                كل الحالات</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['casesType' => '1']) }}">حالات مميزة</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['casesType' => '0']) }}">حالات عادية</a></li>
                        </ul>
                    </div>
                </x-slot>

            </x-admin.search-bar-add-button>

            <div class="wg-table">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:100px">ID</th>
                                <th>اسم الحالة</th>
                                <th>الطبيب</th>
                                <th>صورة قبل</th>
                                <th>صورة بعد</th>
                                <th>حالة خاصة</th>
                                <th>تاريخ الإضافة</th>
                                <th style="width:150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($specialCases as $case)
                                <tr>
                                    <td>{{ $case->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.special-cases.show', $case) }}" class="body-title-2">
                                            {{ $case->title }}
                                        </a>
                                    </td>
                                    <td>{{ $case->doctor->name ?? $case->doctor_name }}</td>
                                    <td>
                                        @if ($case->before_image)
                                            <img src="{{ asset($case->before_image) }}" alt="Before"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($case->after_image)
                                            <img src="{{ asset($case->after_image) }}" alt="After"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($case->is_special_case)
                                            <span class="badge bg-success">نعم</span>
                                        @else
                                            <span class="badge bg-secondary">لا</span>
                                        @endif
                                    </td>
                                    <td>{{ $case->created_at->format('M d, Y | H:i:s') }}</td>
                                    <td>
                                        <div class="list-icon-function">

                                            {{-- view --}}
                                            <a href="{{ route('admin.special-cases.show', $case) }}">
                                                <div class="item eye btn btn-sm fs-5 btn-info" title="view">
                                                    <i class="icon-eye text-white"></i>
                                                </div>
                                            </a>


                                            {{-- edit --}}
                                            @can(PermissionsEnum::edit_case)
                                                <x-admin.forms.edit-form-button stringRoute="admin.special-cases.edit"
                                                    :parameter="$case" />
                                            @endcan

                                            {{-- delete --}}
                                            @can(PermissionsEnum::delete_case)
                                                <x-admin.forms.delete-form-button stringRoute="admin.special-cases.destroy"
                                                    :parameter="$case" />
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center h6 p-2 mt-3 text-danger">لا توجد حالات
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="divider"></div>
            <x-admin.pagination :attribute="$specialCases" />
        </div>
    </div>
</x-admin.layout>
