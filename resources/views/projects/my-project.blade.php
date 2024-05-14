@php
    $user = auth()->user();
    $project = App\Models\Project::where('group_id', $user->group_id)->first();
@endphp
<div class="flex items-center justify-center p-6">
        @if ($project === null)
        <div class="flex items-center justify-center w-[80rem] max-w-7xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            @include('projects.project-index')
        </div>    
        @else
        <div class="grid lg:grid-cols-3 md:grid-cols-1 w-[80rem] max-w-7xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <x-user-info label="{{ __('app.project_name') }}">{{ $project->name }}</x-user-info>
            
            <x-user-info label="{{ __('app.project_field') }}"> {{ $project->projectfield }} </x-user-info>
            <x-user-info label="{{ __('app.project_tech') }}"> {{ $project->projecttech }} </x-user-info>
            <x-user-info label="{{ __('app.state')  }}">
            @if ($project->status == 'declined')
                <span class="bg-red-100 text-red-800 text-lg font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-700 dark:text-red-300">{{ __('app.declined') }}</span>
                <x-user-info label="{{ __('app.project_feedback')  }}"> {{ $project->feedback }} </x-user-info>
                @if ($user->state === 'group_leader')
                <a href="{{ route('updateproject', $project->id) }}" class="inline-flex items-center px-4 py-2 mr-4 bg-royalblue-100 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-royalblue-400 dark:hover:bg-white focus:bg-royalblue-400 dark:focus:bg-white active:bg-royalblue-300 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-royalblue-300 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">{{ __('app.project_update') }}</a>
                @endif
            @elseif ($project->status == 'pending')
                <span class="bg-yellow-100 text-yellow-800 text-lg font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">{{ __('app.pending') }}</span>
            @elseif ($project->status == 'approved')
                <span class="bg-green-100 text-green-800 text-lg font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{ __('app.confirmed') }}</span>
            @endif
        </x-user-info>
        </div>    
        @endif
    
</div>