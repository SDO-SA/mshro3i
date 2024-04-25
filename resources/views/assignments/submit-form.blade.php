<x-app-layout>
    <article class="mt-10 mx-auto p-5 max-w-3xl">
        <div class="mt-2 flex justify-between items-center">
            <div class="flex py-5 text-base items-center">
                <h3 class='font-bold'>{{$assignment->name}}</h3>
            </div>
            <div class="flex items-center">
                <span class="text-gray-500 mr-2">{{ $assignment->points }}</span>  
            </div>
        </div>
        <div class="article-content py-3 text-gray-800 text-lg text-justify">
            {!! $assignment->deliverables !!}
        </div>
    </article>
    <form method="POST" action="{{ route('assignments.submit', $assignment->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="mt-4">
            <x-required-input for="notes" :value="__('app.abstract')" />
            <textarea id="notes" class="block mt-1 w-full 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'" name="notes" required autofocus>{{ old('notes') }}</textarea>
            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-required-input for="attachment" :value="__('app.project_proposal')" />
            <input id="attachment" class="block mt-1 w-full 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'" type="file" name="attachment" accept=".pdf" required />
            <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('app.create') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>