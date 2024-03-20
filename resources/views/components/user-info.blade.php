@props(['label'])

<div class="flex justify-between mb-4">
    <p class="font-bold w-32 text-gray-700 dark:text-gray-400">{{ $label }}</p>
    <p class="flex-grow text-gray-700 dark:text-gray-400 font-normal">{{ $slot }}</p>
</div>