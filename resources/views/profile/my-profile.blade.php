@php
    $user = auth()->user();
    $department = App\Models\Department::find($user->department_id);
    $group = App\Models\Group::find($user->group_id);
@endphp
<div class="flex items-center justify-center p-6">
    <div class="grid lg:grid-cols-3 md:grid-cols-1 w-[80rem] max-w-7xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">  
        {{-- Displaying Student name --}}
        <x-user-info label="Name">{{ $user->name }}</x-user-info>
        {{-- Displaying ID --}}
        <x-user-info label="Student ID">{{ $user->university_id }}</x-user-info>
        {{-- Displaying E-mail --}}
        <x-user-info label="Email">{{ $user->email }}</x-user-info>
        {{-- Displaying Department --}}
        <x-user-info label="Department">{{ $department->department }}</x-user-info>
        {{-- Displaying Group --}}
        @if ($user->group_id == null)
            <x-user-info label="Group">No Group</x-user-info>
        @else
            <x-user-info label="Group">{{ $group->name }}</x-user-info>
        @endif
        {{-- Displaying User State --}}
        @if ($user->state == 'group_leader')
        <x-user-info label="State">Group Leader</x-user-info>
        @elseif ($user->state == 'group_member')
        <x-user-info label="State">Group Member</x-user-info>
        @elseif ($user->state == 'not_joined')
        <x-user-info label="State">Not a Member</x-user-info>
        @endif   
    </div>
</div>