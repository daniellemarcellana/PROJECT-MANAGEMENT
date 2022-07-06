<link rel="icon" type="image/png" href="{{ asset('/images/app-logo.png') }}">
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{asset('/images/app-logo.png')}}" width="300"> </a>

        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="fName" value="{{ __('First Name') }}" />
                <x-jet-input id="fName" class="block mt-1 w-full" type="text" name="fName" :value="old('fName')" required autofocus autocomplete="fName" />
            </div>

            <div class="mt-4">
                <x-jet-label for="midInit" value="{{ __('Middle  Name') }}" />
                <x-jet-input id="midInit" class="block mt-1 w-full" type="text" name="midInit" :value="old('midInit')" required autofocus autocomplete="midInit" />
            </div>

            <div class="mt-4">
                <x-jet-label for="lName" value="{{ __('Last Name') }}" />
                <x-jet-input id="lName" class="block mt-1 w-full" type="text" name="lName" :value="old('lName')" required autofocus autocomplete="lName" />
            </div>

            <div class="mt-4">
                <x-jet-label for="stud_num" value="{{ __('Student Number') }}" />
                <x-jet-input id="stud_num" class="block mt-1 w-full" type="number" name="stud_num" :value="old('stud_num')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="yrLvl" value="{{ __('Year Level') }}" />
                
                <select id="yrLvl" class="block mt-1 w-full" name="yrLvl" :value="old('yrLvl')" required autofocus autocomplete="yrLvl">
                    <option value="" selected disabled>---</option>
                    <option value="1">1st Year</option>
                    <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                    <option value="5">5th Year</option>
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="phone" value="{{ __('Phone') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
            </div>

            <div class="mt-4">
                <x-jet-label for="address" value="{{ __('Address') }}" />
                <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>



            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <x-jet-label for="terms">
                    <div class="flex items-center">
                        <x-jet-checkbox name="terms" id="terms" />

                        <div class="ml-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-jet-label>
            </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>