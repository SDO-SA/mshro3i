@php
    $user = auth()->user();
    $department = App\Models\Department::find($user->department_id);
    $group = App\Models\Group::find($user->group_id);
    $college = App\Models\College::find($user->college_id);
@endphp
<div class="flex items-center justify-center p-6">
    <div class="grid lg:grid-cols-3 md:grid-cols-1 w-[80rem] max-w-7xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

        <x-user-info label="{{ __('app.name') }}">{{ $user->name }}</x-user-info>
        
        <x-user-info label="{{ __('app.uni_id') }}">{{ $user->university_id }}</x-user-info>
        
        @if ($user->state == 'group_leader')
        <x-user-info label="{{ __('app.state') }}">{{ __('app.state_group_leader') }}</x-user-info>
        @elseif ($user->state == 'group_member')
        <x-user-info label="{{ __('app.state') }}">{{ __('app.state_group_member') }}</x-user-info>
        @elseif ($user->state == 'not_joined')
        <x-user-info label="{{ __('app.state') }}">{{ __('app.state_not_member') }}</x-user-info>
        @endif
        
        <x-user-info label="{{__('app.college')}}">{{ $college->name_ar }}</x-user-info>

        <x-user-info label="{{__('app.department')}}">{{ $department->name_ar }}</x-user-info>
        
        @if ($user->group_id == null)
            <x-user-info label="{{__('app.group')}}">{{__('app.group_state')}}</x-user-info>
        @else
            <x-user-info label="{{__('app.group')}}">{{ $group->name }}</x-user-info>
        @endif  
    </div>
</div>