@props([
    'lable',
    'name',
    'defaultSelection',
    'objects',
    'isEditPage' => false,
    'MianObject' => null,
    'togetFirstIdFrom' => null,
])


{{-- {{dd($objects->first())}} --}}

<fieldset class="">
    <div class="body-title mb-10">{{ $lable }}<span class="tf-color-1">*</span>
    </div>
    <div class="select">
        <select name="{{$name}}" {{ $attributes(['class', 'style']) }}>
            <option value="{{ old($name , '') }}">
                {{ $objects->find(old($name))->name ?? $defaultSelection }}</option>
            @foreach ($objects as $object)
                <option value="{{ $object->id }}"
                    @if ($isEditPage) {{ $object->id == (isset($MianObject->$togetFirstIdFrom) ? $MianObject->$togetFirstIdFrom->first()->id : '') ? 'selected' : '' }} @endif>
                    {{ $object->name }}</option>
            @endforeach
        </select>
    </div>
    <x-admin.forms.error :error="$errors->first($name)" />
</fieldset>
