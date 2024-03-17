<x-guest-layout>
    <form method="POST" action="{{ route('createproject') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Project Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="abstract" :value="__('Abstract')" />
            <textarea id="abstract" class="block mt-1 w-full 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'" name="abstract" required autofocus>{{ old('abstract') }}</textarea>
            <x-input-error :messages="$errors->get('abstract')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="projectfield" :value="__('Project Fields')" />
        
            <div class="flex flex-wrap mt-2">
                <label for="education" class="checkbox-label block font-medium text-sm text-gray-700 dark:text-gray-300">
                    <input id="education" class="mr-2" type="checkbox" name="projectfield[]" value="Education" {{ in_array('Education', old('projectfield', [])) ? 'checked' : '' }}>Education
                </label>
        
                <label for="health" class="checkbox-label block font-medium text-sm text-gray-700 dark:text-gray-300 ">
                    <input id="health" class="mr-2" type="checkbox" name="projectfield[]" value="Health" {{ in_array('Health', old('projectfield', [])) ? 'checked' : '' }}>Health
                </label>
        
                <label for="science" class="checkbox-label block font-medium text-sm text-gray-700 dark:text-gray-300">
                    <input id="science" class="mr-2" type="checkbox" name="projectfield[]" value="Science" {{ in_array('Science', old('projectfield', [])) ? 'checked' : '' }}>Science
                </label>
            </div>
            <x-input-error :messages="$errors->get('projectfield')" class="mt-2" />
        </div>

        <!-- Attachment -->
        <div class="mt-4">
            <x-input-label for="attachment" :value="__('Project Proposal')" />
            <input id="attachment" class="block mt-1 w-full 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'" type="file" name="attachment" accept=".pdf" required />
            <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
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
