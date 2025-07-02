@php
    use App\Enum\PermissionsEnum;
@endphp

<x-admin.layout>

    <div class="main-content-wrap">

        <x-admin.page-heading title="الأطباء" />

        <div class="wg-box">

            <x-admin.search-bar-add-button placeholder="(إسم الطبيب)" :create_route="route('admin.doctors.create')" :can="PermissionsEnum::create_doctor->value" />

            <div class="wg-table">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:100px">ID</th>
                                <th>الإسم</th>
                                <th>الخبرة</th>
                                <th>رقم الهاتف</th>
                                <th>القسم</th>
                                <th>حسابات تواصل</th>
                                <th>تاريخ الإضافة</th>
                                <th style="width:150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($doctors as $doctor)
                                <tr>
                                    <td>{{ $doctor->id }}</td>
                                    <td class="pname">
                                        <div class="flex items-center flex-wrap justify-around gap-3 ">
                                            @if ($doctor->image)
                                                <div class="image">
                                                    <img src="{{ asset('storage/' . $doctor->image) }}" alt="user"
                                                        class="rounded-circle"
                                                        style="width: 40px; height: 40px; object-fit: cover;">
                                                </div>
                                            @endif
                                            <div class="name">
                                                <p class="body-title-2 fs-5">{{ $doctor->name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td title="{{ $doctor->experince }}">{{ $doctor->getFirstTenWordsFromTheExpe() }}
                                    </td>
                                    <td>{{ $doctor->phone }}</td>
                                    <td class="fst-italic">{!! $doctor->department->name ?? '<b>null</b>' !!}</td>

                                    <td>
                                        <div class="d-flex flex-column" style="font-weight: bold;">
                                            @if ($doctor->email != null)
                                                <b title="{{ $doctor->email ?? '#' }}" class="link-danger"
                                                    href="{{ $doctor->email }}" target="_blank">Email</b>
                                            @endif
                                            @if ($doctor->linkedin != null)
                                                <a title="{{ $doctor->linkedin ?? '#' }}" class="link-primary"
                                                    href="{{ $doctor->linkedin }}" target="_blank">linkedin</a>
                                            @endif

                                            @if ($doctor->facebook != null)
                                                <a title="{{ $doctor->facebook ?? '#' }}" class="link-info"
                                                    href="{{ $doctor->facebook ?? '#' }}" target="_blank">facebook</a>
                                            @endif

                                        </div>
                                    </td>
                                    <td>{{ $doctor->created_at->format('M d, Y | H:i:s') }}</td>
                                    <td>
                                        <div class="list-icon-function">
                                            {{-- edit --}}
                                            @can(PermissionsEnum::edit_doctor)
                                                <x-admin.forms.edit-form-button stringRoute="admin.doctors.edit"
                                                    :parameter="$doctor" />
                                            @endcan

                                            {{-- delete --}}
                                            @can(PermissionsEnum::delete_doctor)
                                                <x-admin.forms.delete-form-button stringRoute="admin.doctors.destroy"
                                                    :parameter="$doctor" />
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center h6 p-2 mt-3 text-danger ">No doctors found
                                    </td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>

            <div class="divider"></div>
            <x-admin.pagination :attribute="$doctors" />

        </div>
    </div>


</x-admin.layout>
