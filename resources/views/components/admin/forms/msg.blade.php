@props(['msg' => false , 'msgColor' => 'success' ])

@if ($msg)
    {{-- <div class="alert alert-{{$msgColor}} fs-3 m-0 text-center" role="alert">
        {{ $msg }}
    </div> --}}

     {{-- <div class="alert alert-{{$msgColor}} alert-dismissible fade show" role="alert">
        {{ $msg }}
        <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> --}}
@endif


<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 3500
        });
    @endif
</script>
