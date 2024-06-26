<x-guest-layout>
    <form method="POST" action="{{ route('creategroup') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-required-input for="name" :value="__('app.group_name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="ادخل اسم المجموعة" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-required-input for="supervisor" :value="__('app.group_supervisor')" />
            <select id="supervisor" name="supervisor[]" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required multiple autofocus>
                <option value="" hidden>Select Supervisor</option>
                @foreach($supervisors as $id => $name)
                    <option value="{{ $name }}">{{ $name }}</option>
                @endforeach
            </select>
            <x-input-label :value="__('app.supervisor_limit')"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="groupmembers" :value="__('app.group_members')" />
            <select id="groupmembers" name="groupmembers[]" class="block mt-1 w-full" autofocus multiple>
                @foreach($groupMembers as $member)
                    <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->university_id }})</option>
                @endforeach
            </select>
            <x-input-label :value="__('app.group_members_limit')"/>
            <x-input-error :messages="$errors->get('groupmembers')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('dashboard') }}">
                {{ __('app.cancel') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __('app.create') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
