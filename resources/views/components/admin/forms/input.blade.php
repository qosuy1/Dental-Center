@props(['label' => '', 'name' , 'object' ])

@php
    $defaults = [
        'type' => 'text',
        'id' => $name,
        'name' => $name,
        'class' => 'form-control flex-grow border-3 w-full',
        'value' => old($name ) ?? $object->$name ?? '',

        'tabindex' => '0',

        'aria-required' => 'true',
    ];
@endphp

<x-admin.forms.field :$label :$name>
    <input {{ $attributes($defaults) }}>
</x-admin.forms.field>
