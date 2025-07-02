@props(['label' => '', 'name'])

<fieldset class="name">
    @if ($label)
        <x-admin.forms.label :$name :$label />
    @endif

    <div class="">
        {{ $slot }}

        <x-admin.forms.error :error="$errors->first($name)" />
    </div>
</fieldset>
