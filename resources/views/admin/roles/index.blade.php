@php
    use App\Enum\PermissionsEnum;
@endphp

<x-admin.layout>
    <div class="main-content-wrap">
        <x-admin.page-heading title="Roles Management" />

        <div class="wg-box">
            <x-admin.search-bar-add-button placeholder="Search roles..." :create_route="route('admin.roles.create')"
                :can="PermissionsEnum::create_role->value" :searchBar="false" />

            <div class="wg-table">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 70px">ID</th>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                <th>Users Count</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td class="pname">
                                        <div class="name">
                                            <a href="{{ route('admin.roles.show', $role) }}" class="body-title-2">
                                                {{ $role->name }}
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="permissions-list">
                                            @foreach ($role->permissions->take(3) as $permission)
                                                <span class="badge bg-info fs-6">{{ $permission->name }}</span>
                                            @endforeach
                                            @if ($role->permissions->count() > 3)
                                                <a href="{{ route('admin.roles.show', $role) }}"
                                                    class="badge bg-secondary">+{{ $role->permissions->count() - 3 }}
                                                    more</a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $role->users_count ?? 0 }}</td>
                                    <td>{{ $role->created_at->format('M d, Y | H:i:s') }}</td>
                                    <td>
                                        <div class="list-icon-function">
                                            @if ($role->name != 'Super Admin')
                                                @can(PermissionsEnum::edit_role)
                                                    <a href="{{ route('admin.roles.edit', $role) }}"
                                                        class="btn btn-sm fs-5 btn-primary" title="Edit Role">
                                                        <i class="icon-edit-3"></i>
                                                    </a>
                                                @endcan

                                                @can(PermissionsEnum::delete_role)
                                                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger fs-5"
                                                            onclick="return confirm('Are you sure you want to delete this role?')"
                                                            title="Delete Role">
                                                            <i class="icon-trash-2"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center h6 p-2 mt-3 text-danger ">No roles found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="divider"></div>
            <x-admin.pagination :attribute="$roles" />
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
