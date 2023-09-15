<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form class="mt-6 space-y-6" method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input class="form-control mt-1" id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Address')" />
            <x-text-input class="form-control mt-1" id="name" name="address" type="text" :value="old('address', $user->address)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('State')" />
            <select class="form-select mt-1" id="" name="state_id">
                @foreach ($states as $state)
                    <option value="{{ $state->id }}" @selected(old('state_id', $user->state_id) == $state->id)>{{ $state->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <x-input-label for="name" :value="__('Bank')" />
            <select class="form-select mt-1" id="" name="bank_id">
                @foreach ($banks as $bank)
                    <option value="{{ $bank->id }}" @selected(old('bank_id', $user->bank_id) == $bank->id)>{{ $bank->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <x-input-label for="name" :value="__('Bank Number')" />
            <x-text-input class="form-control mt-1" id="name" name="bank_number" type="text" :value="old('bank_number', $user->bank_number)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input class="form-control mt-1" id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" form="send-verification">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-gray-600" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
