<div class="header-dashboard">
    <div class="wrap">
        <div class="header-left">
            <a href="{{ route('admin.index') }}">
                <h3 style="font-size: 28px; color:#356bde ;">Dental Center</h3>
            </a>
            <div class="button-show-hide">
                <i class="icon-menu-left"></i>
            </div>
        </div>
        <div class="header-grid">

            <div class="popup-wrap message type-header">
                <div class="dropdown">
                </div>
            </div>


            <div class="popup-wrap user type-header">
                <div class="dropdown">

                    <button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownMenuButton3"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="header-user wg-user">
                            <span class="image">
                                <img src="{{ asset('adminAssets/images/avatar/user.jpeg') }}" alt="">
                            </span>
                            <span class="flex flex-column">
                                <span class="body-title mb-2">{{ Auth::user()->name }}</span>
                                <span class="text-tiny">{{ Auth::user()->roles->first()->name }}</span>
                            </span>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end has-content modern-dropdown"
                        aria-labelledby="dropdownMenuButton3"
                        style="min-width:220px; border-radius: 14px; box-shadow: 0 8px 24px rgba(53,107,222,0.10); padding: 12px 0; border: none;">
                        <li>
                            <a href="{{ route('profile.edit') }}"
                                class="user-item d-flex align-items-center gap-3 px-4 py-2"
                                style="transition: background 0.2s; border-radius: 8px;">
                                <div class="icon" style="background: #eaf1fb; border-radius: 50%; padding: 8px;">
                                    <i class="icon-user" style="color: #356bde; font-size: 18px;"></i>
                                </div>
                                <div class="body-title-2" style="font-weight: 500;">Profile</div>
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post" style="margin:0;">
                                @csrf
                                <button type="submit" class="user-item d-flex align-items-center gap-3 px-4 py-2"
                                    style="background: none; border: none; width: 100%; text-align: left; transition: background 0.2s; border-radius: 8px; cursor:pointer;">
                                    <div class="icon" style="background: #ffeaea; border-radius: 50%; padding: 8px;">
                                        <i class="icon-log-out" style="color: #de3535; font-size: 18px;"></i>
                                    </div>
                                    <div class="body-title-2" style="font-weight: 500;">Log out</div>
                                </button>
                            </form>
                        </li>
                    </ul>
                    <style>
                        .modern-dropdown .user-item:hover,
                        .modern-dropdown .user-item:focus {
                            background: #f4f8ff !important;
                        }
                    </style>
                </div>
            </div>

        </div>
    </div>
</div>
