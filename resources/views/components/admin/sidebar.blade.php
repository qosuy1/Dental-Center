@php
    use App\Enum\PermissionsEnum;
@endphp

<div class="section-menu-left" style="order: 2;">
    <div class="box-logo">
        <dev id="site-logo-inner">
            <h3 style="font-size: 28px; color:#356bde ;">Dental Center</h3>
        </dev>
        <div class="button-show-hide">
            <i class="icon-menu-left"></i>
            <a href=""></a>
        </div>
    </div>
    <div class="center">

        <div class="center-item">
            <div class="center-heading">Main Home</div>
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="{{ route('admin.index') }}" class="">
                        <div class="icon"><i class="icon-grid"></i></div>
                        <div class="text">الصفحة الرئيسية</div>
                    </a>
                </li>
            </ul>
        </div>
        <hr>
        <div class="center-item">
            <ul class="menu-list">

                {{-- users --}}
                @canany([PermissionsEnum::create_user, PermissionsEnum::edit_user, PermissionsEnum::view_user,
                    PermissionsEnum::delete_user])
                    <li class="menu-item has-children">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-users"></i></div>
                            <div class="text">المستخدمين (users)</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                @can(PermissionsEnum::create_user)
                                    <a href="{{ route('admin.users.create') }}" class="">
                                        <div class="text">إضافة مستخدم</div>
                                    </a>
                                @endcan
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.users.index') }}" class="">
                                    <div class="text">عرض المستخدمين</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcanany

                {{-- roles --}}
                @canany([PermissionsEnum::create_role, PermissionsEnum::edit_role, PermissionsEnum::view_role,
                    PermissionsEnum::delete_role])
                    <li class="menu-item has-children">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-lock"></i></div>
                            <div class="text">الأدوار (roles)</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                @can(PermissionsEnum::create_role)
                                    <a href="{{ route('admin.roles.create') }}" class="">
                                        <div class="text">إضافة دور</div>
                                    </a>
                                @endcan
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.roles.index') }}" class="">
                                    <div class="text">عرض الأدوار</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcanany
                <hr>

                {{-- blogs --}}
                @canany([PermissionsEnum::create_blog, PermissionsEnum::edit_blog, PermissionsEnum::view_blog,
                    PermissionsEnum::delete_blog])
                    <li class="menu-item has-children">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-file-text"></i></div>
                            <div class="text">مقالات</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                @can(PermissionsEnum::create_blog)
                                    <a href="{{ route('admin.blogs.create') }}" class="">
                                        <div class="text">إضافة مقال</div>
                                    </a>
                                @endcan
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.blogs.index') }}" class="">
                                    <div class="text">عرض المقالات</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcanany

                {{-- cases --}}
                @canany([PermissionsEnum::create_case, PermissionsEnum::edit_case, PermissionsEnum::view_case,
                    PermissionsEnum::delete_case])
                    <li class="menu-item has-children">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-layers"></i></div>
                            <div class="text">كل الحالات</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                @can(PermissionsEnum::create_case)
                                    <a href="{{ route('admin.special-cases.create') }}" class="">
                                        <div class="text">إضافة حالة</div>
                                    </a>
                                @endcan
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.special-cases.index') }}">
                                    <div class="text">عرض الحالات</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcanany

                {{-- doctors --}}
                @canany([PermissionsEnum::create_doctor, PermissionsEnum::edit_doctor, PermissionsEnum::view_doctor,
                    PermissionsEnum::delete_doctor])
                    <li class="menu-item has-children">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-users"></i></div>
                            <div class="text">الأطباء</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                @can(PermissionsEnum::create_doctor)
                                    <a href="{{ route('admin.doctors.create') }}" class="">
                                        <div class="text">إضافة طبيب</div>
                                    </a>
                                @endcan
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.doctors.index') }}" class="">
                                    <div class="text">عرض الأطباء</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcanany

                {{-- departmetns --}}
                @canany([PermissionsEnum::create_department, PermissionsEnum::edit_department,
                    PermissionsEnum::view_department, PermissionsEnum::delete_department])
                    <li class="menu-item has-children">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-file"></i></div>
                            <div class="text">الأقسام</div>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                @can(PermissionsEnum::create_department)
                                    <a href="{{ route('admin.departments.create') }}" class="">
                                        <div class="text">إضافة قسم</div>
                                    </a>
                                @endcan
                            </li>
                            <li class="sub-menu-item">
                                <a href="{{ route('admin.departments.index') }}" class="">
                                    <div class="text">عرض الأقسام</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcanany

                {{-- settings --}}
                @can(PermissionsEnum::settings)
                    <li class="menu-item">
                        <a href="{{ route('admin.settings.index') }}" class="">
                            <div class="icon"><i class="icon-settings"></i></div>
                            <div class="text">الأعدادات</div>
                        </a>
                    </li>
                @endcan

            </ul>
        </div>
        <div class="center-item">
            <ul class="menu-list">
                <li class="menu-item">
                    <form action="{{ route('logout') }}" method="post" style="margin:0;">
                        @csrf
                        <button type="submit" class="menu-item-button"
                            style="background: none; border: none; width: 100%; text-align: left; display: flex; align-items: center; gap: 10px; padding: 10px 16px; border-radius: 8px; transition: background 0.2s; cursor:pointer;">
                            <div class="icon" style="background: #ffeaea; border-radius: 50%; padding: 8px;">
                                <i class="icon-log-out" style="color: #de3535; font-size: 18px;"></i>
                            </div>
                            <div class="text" style="font-weight: 500;">تسجيل الخروج</div>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <style>
            .menu-list .menu-item-button:hover,
            .menu-list .menu-item-button:focus {
                background: #f4f8ff !important;
            }
        </style>
    </div>
</div>
