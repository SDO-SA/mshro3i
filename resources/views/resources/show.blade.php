<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('app.resources') }}
        </h2>
    </x-slot>
    <iframe src="{{ $pdfurl }}" width="100%" height="800px"></iframe>
</x-app-layout>