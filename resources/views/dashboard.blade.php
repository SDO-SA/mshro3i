
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('app.dashboard') }}
        </h2>
    </x-slot>
    
    @include('profile.my-profile')

    @can('canSeeProjectInfo', App\Models\Project::class)
        @include('projects.my-project')
    @endcan

    @can('viewGroupButtons', App\Models\Group::class)
        @include('groups.group-index')
    @endcan

    @can('canShowMyGroup', App\Models\Group::class)
    <div class="flex justify-center">
        <div class="">
         @include('groups.my-group')   
        </div>
        <div class="">
        @include('groups.announcement-card')    
        </div>
        
    </div>
    @endcan

    
    
</x-app-layout>
