
@props(['attribute' => false])

<div class="d-flex justify-content-center flex-wrap gap-10 wgp-pagination fs-3 mt-12">
    @if($attribute && method_exists($attribute, 'links'))
        {{ $attribute->links() }}
    @endif
</div>