@props(['stringRoute', 'parameter'])

{{-- Edit --}}
<a href="{{ route($stringRoute, $parameter) }}" class="btn btn-sm fs-5 btn-primary" title="Edit">
    <i class="icon-edit-3"></i>
</a>
