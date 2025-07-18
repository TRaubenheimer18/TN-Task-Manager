<x-guest-layout>
    <style>
            body {
                background-color: #F4C2C2;
            }


        </style>

    <div class="min-h-screen flex flex-col justify-center items-center bg-pink-500 py-6">
        <div class="w-full max-w-md p-6 rounded-lg bg-white shadow-md">
            <form method="POST" action="{{ route('register') }}">
                @csrf


                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>


                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>


                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>


                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>


                <div class="mt-4">
                    <label for="role" class="block font-medium text-sm text-gray-700">Register As</label>
                    <select id="role" name="role" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-pink-500 focus:border-pink-500">
                        <option value="member">Team Member</option>
                        <option value="guest">Guest</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                
                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>





