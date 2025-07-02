@props(['stringRoute', 'parameter'])

{{-- delete --}}
<form action="{{ route($stringRoute, $parameter) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger fs-5" onclick="return confirm('هل أنت متأكد انك تريد الحذف')"
        title="Delete">
        <i class="icon-trash-2"></i>
    </button>
</form>
