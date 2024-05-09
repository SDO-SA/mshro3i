<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('app.assignments') }}
        </h2>
    </x-slot>
    
    <div class="bg-white border mt-10 max-w-3xl mx-auto rounded-lg shadow border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <article class="mx-auto px-5 max-w-3xl">
        <div class="mt-2 flex justify-between items-center">
            <div class="flex py-5 text-base items-center">
                <h3 class='font-bold'>{{$assignment->name}}</h3>
            </div>
            <div class="flex items-center">
                <span class="text-gray-500 mr-2 font-bold">{{ __('app.points') }} {{ $assignment->points }}</span>  
            </div>
        </div>
        <div class="article-content py-3 text-lg text-justify">
            {!! $assignment->deliverables !!}
        </div>
    </article>
    <form method="POST" action="{{ route('assignments.submit', $assignment->id) }}" enctype="multipart/form-data" class="mx-auto p-5 max-w-3xl">
        @csrf
        <div class="mt-4">
            <x-input-label for="notes" :value="__('app.assignment_note')" />
            <textarea id="notes" class="block mt-1 w-full 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'" name="notes" autofocus>{{ old('notes') }}</textarea>
            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-required-input for="attachment" :value="__('app.assignment_file_upload')" />
            <input id="attachment" class="block mt-1 w-full 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'" type="file" name="attachment" accept=".pdf" required />
            <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('app.create') }}
            </x-primary-button>
        </div>
    </form>
   </div>
</x-app-layout>