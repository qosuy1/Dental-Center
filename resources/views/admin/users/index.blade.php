@php
    use App\Enum\PermissionsEnum;
@endphp

<x-admin.layout>



    <div class="main-content-wrap">

        <x-admin.page-heading title="Users" />

        <div class="wg-box">

            <x-admin.search-bar-add-button placeholder="(admin name)" :create_route="route('admin.users.create')" :can="PermissionsEnum::create_user->value" />

            <div class="wg-table ">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 70px">ID</th>
                                <th>إسم المستخدم</th>
                                <th>البريد الإلكتروني</th>
                                <th>الصلاحيات (roles)</th>
                                <th>تاريخ الإضافة</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>

                                    <td class="pname">
                                        <div class="name text-center">
                                            <p class="body-title-2 fs-5">{{ $user->name }}</p>
                                        </div>

                                    </td>

                                    <td>
                                        {{-- <b title="{{ $user->email ?? '#' }}" class="link-danger"
                                        href="{{ $user->email }}" target="_blank">Email</b> --}}
                                        {{ $user->email }}
                                    </td>

                                    <td class="fw-bold text-info">{{ $user->roles->first()->name ?? '-' }}</td>
                                    <td>{{ $user->created_at->format('M d, Y | H:i:s') }}</td>

                                    <td>
                                        <div class="list-icon-function">
                                            {{-- edit --}}
                                            @can(PermissionsEnum::edit_user)
                                                <x-admin.forms.edit-form-button stringRoute="admin.users.edit"
                                                    :parameter="$user" />
                                            @endcan
                                            {{-- delete --}}
                                            @can(PermissionsEnum::delete_user)
                                                <x-admin.forms.delete-form-button stringRoute="admin.users.destroy"
                                                    :parameter="$user" />
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center h6 p-2 mt-3 text-danger">no users (only you)
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="divider"></div>
            <x-admin.pagination :attribute="$users" />

        </div>
    </div>


</x-admin.layout>
