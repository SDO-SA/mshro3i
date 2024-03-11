<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Groups') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mt-4 mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-5 gap-4">
            @foreach ($groups as $group)
                <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative">
                    <div class="p-6">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $group->name }}</h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Total Members: {{$group->total_members}}</p>
                        <a href="{{ route('joingroup', ['groupId' => $group->id]) }}" class="absolute bottom-4 right-4 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Join
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
