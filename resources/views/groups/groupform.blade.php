<x-guest-layout>
    <form method="POST" action="{{ route('creategroup') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Group Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="supervisor" :value="__('Supervisor')" />
            <x-text-input id="supervisor" class="block mt-1 w-full" type="text" name="supervisor" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Create') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
