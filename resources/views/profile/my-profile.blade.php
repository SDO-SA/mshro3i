@php
    $user = auth()->user();
    $stateLabels = [
        'group_leader' => __('app.state_group_leader'),
        'group_member' => __('app.state_group_member'),
        'not_joined' => __('app.state_not_member'),
    ];
@endphp
<div class="flex items-center justify-center p-6">
    <div class="grid lg:grid-cols-3 md:grid-cols-1 w-[80rem] max-w-7xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

        <x-user-info label="{{ __('app.name') }}">{{ $user->name }}</x-user-info>
        
        <x-user-info label="{{ __('app.uni_id') }}">{{ $user->university_id }}</x-user-info>
        
        <x-user-info label="{{ __('app.state') }}">
            {{ $stateLabels[$user->state] ?? __('app.unknown_state') }}
        </x-user-info>
        
        <x-user-info label="{{__('app.college')}}">{{ $user->college->name_ar }}</x-user-info>

        <x-user-info label="{{__('app.department')}}">{{ $user->department->name_ar }}</x-user-info>
        
        @if ($user->group_id == null)
            <x-user-info label="{{__('app.group')}}">{{__('app.group_state')}}</x-user-info>
        @else
            <x-user-info label="{{__('app.group')}}">{{ $user->group->name }}</x-user-info>
        @endif  
    </div>
</div>