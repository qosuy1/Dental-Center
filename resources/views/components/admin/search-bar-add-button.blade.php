@php
    use app\Enum\PermissionsEnum;
@endphp

@props([
    'searchBar' => true,

    'placeholder' => '',
    'create_route',
    'can' => '', // temporarily
])

<div class="flex items-center justify-between gap10 flex-wrap">
    <div class="wg-filter ">
        @if ($searchBar)
            <form class="form-search" action="" method="GET">
                <fieldset class="name">
                    <input type="text" placeholder="أبحث هنا...{{ $placeholder }}" class="" name="search"
                        tabindex="2" value="{{ request('search') }}" aria-required="true" >
                </fieldset>
                <div class="button-submit">
                    <button class="" type="submit"><i class="icon-search"></i></button>
                </div>
            </form>
        @endif
        {{$dropdownMenu}}
    </div>

    <div class="d-flex gap-4">
        {{-- {{$dropdownMenu}} --}}

        <div class="dropdown">
            <button class="tf-button style-1 w2 dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                التاريخ
            </button>
            <ul class="dropdown-menu fs-4">
                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}">الاحدث</a>
                </li>
                <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['sort' => 'asc'])}}">الاقدم</a></li>
            </ul>
        </div>

        @can($can)
            <a class="tf-button style-1 w208" href="{{ $create_route }}"><i class="icon-plus"></i>إضافة</a>
        @endcan

    </div>


</div>
