<x-guest-layout>
    <form method="POST" action="{{ route('creategroup') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Group Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="supervisor" :value="__('Supervisor')" />
            <x-text-input id="supervisor" class="block mt-1 w-full" type="text" name="supervisor" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> --}}

        <div class="mt-4">
            <x-input-label for="groupmembers" :value="__('Group Members')" />
            <select id="groupmembers" name="groupmembers[]" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus multiple>
                <option value="" selected hidden>Select Group Members</option>
                @foreach($groupMembers as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('dashboard') }}">
                {{ __('Cancel') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __('Create') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
