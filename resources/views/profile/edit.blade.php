<x-admin.layout>

    {{-- @dd(session('status')) --}}

    <div class="main-content-wrap">

        <x-admin.page-heading title="Profile" />

        <div class="wg-box">

            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf
                @method('patch')

                {{-- username --}}
                <div>
                    <fieldset class="name">
                        <x-admin.forms.input label="Name" name="name" :object="auth()->user()" />
                    </fieldset>
                </div>

                {{-- emial --}}
                <div>
                    <x-admin.forms.input label="Email" name="email" :object="auth()->user()" />

                    {{-- if the user not verified will show verfication button --}}
                    {{-- @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail()) --}}
                    @if (!$user->hasVerifiedEmail())

                        <div>
                            <p class="fs-4 mt-2 text-red-500">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification"
                                    class="underline fs-4 text-gray-600 hover:text-blue-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium fs-4 text-green-600">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="fs-4 text-green-600  rounded-xl ">{{ __('Saved') }}</p>
                    @endif
                </div>
            </form>
        </div>

        {{-- password --}}
        <div class="wg-box my-4">
            <form method="post" action="{{ route('password.update') }}" class="space-y-4 px-60">
                @csrf
                @method('put')

                <fieldset class="current_password">
                    <x-admin.forms.input label="Current Password" name="current_password" type="password" />
                </fieldset>

                <fieldset class="new_password">
                    <x-admin.forms.input label="New Password" name="password" type="password" />
                </fieldset>

                <fieldset class="confirem_new_password">
                    <x-admin.forms.input label="Confirm Password" name="password_confirmation" type="password" />
                </fieldset>

                <div class="flex items-center gap-4">
                    <x-primary-button> {{ __('Save') }} </x-primary-button>


                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="fs-4 text-gray-600">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-admin.layout>
