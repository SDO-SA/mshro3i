<x-app-layout>
<div class="flex flex-wrap justify-center py-12">
    @foreach ($groups as $group)
        <div class="">
            <div class="p-5 text-center">
                <p class="dark:text-gray-300">Group Name: {{ $group->name }}</p>
            </div>
            <div class="flex items-center justify-center">
                <x-secondary-button> Join </x-secondary-button>
            </div>
        </div>
    @endforeach
</div>
</x-app-layout>
