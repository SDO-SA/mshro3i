<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    @can('viewCreateGroup', App\Models\Group::class)
        @include('groups.group-index')
    @endcan
    
</x-app-layout>
