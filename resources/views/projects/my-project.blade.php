@php
    $user = auth()->user();
    $project = App\Models\Project::where('group_id', $user->group_id)->first();
@endphp
<div class="flex items-center justify-center p-6">
    <div class="grid lg:grid-cols-3 md:grid-cols-1 w-[80rem] max-w-7xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        @if ($project === null)
            @include('projects.project-index')
        @else
            <x-user-info label="{{ __('app.project_name') }}">{{ $project->name }}</x-user-info>
            
            <x-user-info label="{{ __('app.project_field') }}"> {{ $project->projectfield }} </x-user-info>
        @endif
    </div>
</div>