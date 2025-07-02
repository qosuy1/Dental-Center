@props([
    'name' => 'icon',
    'selected' => 'fas fa-tooth',
])

@php
    $icons = [
        'fas fa-tooth' => 'سن',
        'fas fa-user-md' => 'طبيب',
        'fas fa-stethoscope' => 'سماعة طبية',
        'fas fa-notes-medical' => 'ملاحظات طبية',
        'fas fa-baby' => 'طفل',
        'fas fa-heartbeat' => 'نبض',
        'fas fa-x-ray' => 'أشعة',
        'fas fa-syringe' => 'حقنة',
        'fas fa-briefcase-medical' => 'حقيبة طبية',
        'fas fa-hospital' => 'مستشفى',
        'fas fa-calendar-check' => 'موعد',
    ];
@endphp

<div class="mb-4">
    <label for="{{ $name }}" class="block mb-1 font-bold text-black">اختر الأيقونة <span class="tf-color-1">*</span>
        <br>
        <span class="text-blue-600">(ليتم عرضها في الصفحة الرئيسية)</span>
    </label>
    <select name="{{ $name }}" id="{{ $name }}"
        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
        @foreach ($icons as $value => $label)
            <option value="{{ $value }}" @selected($value == $selected)>
                {{ $label }}
            </option>
        @endforeach
    </select>

    <div class="mt-2 text-gray-600">
        <span class="text-xl">معاينة:</span>
        <i id="{{ $name }}-preview" class="{{ $selected }} text-6xl ml-2 text-indigo-400"></i>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const select = document.getElementById("{{ $name }}");
            const preview = document.getElementById("{{ $name }}-preview");

            if (select && preview) {
                select.addEventListener('change', function() {
                    preview.className = this.value + " text-6xl ml-2";
                });
            }
        });
    </script>
@endpush
