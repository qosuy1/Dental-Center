@props(['error' => false])

@if ($error)
    <p class="text-danger fs-4">{{ $error }}</p>
@endif
