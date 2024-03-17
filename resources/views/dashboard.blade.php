
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    @can('viewGroupButtons', App\Models\Group::class)
        @include('groups.group-index')
    @endcan

    @can('canShowMyGroup', App\Models\Group::class)
        @include('groups.my-group')
    @endcan

    @can('canCreateProjectProposal', App\Models\Project::class)
    <div class="flex flex-col items-center justify-center h-96">
        <h2 class="font-semibold text-4xl text-gray-800 dark:text-gray-200 leading-tight">You Don't have a Project yet!</h2>
        <div class="flex mt-4 md:mt-6">
            <a href="{{ url('/project/create-project') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Project Proposal</a>
        </div>
    </div>
    @endcan
    
</x-app-layout>
