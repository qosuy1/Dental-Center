@php
    use App\Enum\PermissionsEnum;
@endphp

<x-admin.layout>
    <div class="main-content-wrap">
        <x-admin.page-heading title="Role View" />

        <div class="wg-box">

            <h3>{{ $role->name }}</h3>

            <hr>

            <div class="permissions-list">
                @foreach ($role->permissions as $permission)
                    <span class="badge bg-info fs-3">{{ $permission->name }}</span>
                @endforeach
            </div>

            <hr>

            <div class="d-flex justify-between gap-3">
                <a href="{{ route('admin.roles.index') }}" class="tf-button tf-button-small style-3"
                    style="font-size: 14px">back</a>

                <div class="d-flex justify-content-between gap-3">

                    @if ($role->name != 'Super Admin')
                        @can(PermissionsEnum::edit_role)
                            <a href="{{ route('admin.roles.edit', $role) }}" class="tf-button tf-button-small style-1"
                                style="font-size: 14px">edit</a>
                        @endcan
                        @can(PermissionsEnum::delete_role)
                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="delete"
                                    class="tf-button tf-button-small style-1"style="font-size: 14px"
                                    onclick="return confirm('Are you sure you want to delete this role ?')">
                                    delete</button>
                            </form>
                        @endcan
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .permissions-list {
                display: flex;
                flex-wrap: wrap;
                gap: 0.8rem;
            }

            .badge {
                font-size: 0.8rem;
                padding: 0.35em 0.65em;
            }

            .list-icon-function {
                display: flex;
                gap: 0.5rem;
                justify-content: center;
            }

            .btn-sm {
                padding: 0.25rem 0.5rem;
            }
        </style>
    @endpush
</x-admin.layout>
