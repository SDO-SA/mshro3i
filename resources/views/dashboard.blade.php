@php
    $user = auth()->user();
    $group = App\Models\Group::where('id', $user->group_id)->first();
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('app.dashboard') }}
        </h2>
    </x-slot>

    @include('profile.my-profile')

    @if (isset($group->supervisor_id))
        @can('canSeeProjectInfo', App\Models\Project::class)
            @include('projects.my-project')
        @endcan
    @endif

    @can('viewGroupButtons', App\Models\Group::class)
        @include('groups.group-index')
    @endcan

    @can('canShowMyGroup', App\Models\Group::class)
        <div class="flex justify-center">
            <div class="grid lg:grid-cols-2 sm:grid-cols-1 gap-4 p-6">
                <div class="max-w-sm min-h-max bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    @include('groups.my-group')
                </div>
                <div class="max-w-sm min-h-max bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    @include('announcements.announcement-card')
                </div>
            </div>
        </div>
    @endcan

    
    
</x-app-layout>
