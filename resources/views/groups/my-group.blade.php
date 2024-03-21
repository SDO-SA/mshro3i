@php
    $user = auth()->user();
    if ($user->state !== 'not_joined') {
        $group = App\Models\Group::find($user->group_id);
        $users = App\Models\User::where('group_id', $group->id)->get();
    }
@endphp
<div class="flex items-center justify-center p-6">
    <div class="max-w-sm p-6 min-w-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        {{-- Displaying Group name and status --}}
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $group->name }}
            @if ($group->status == 'new')
                <span
                    class="bg-gray-100 text-gray-800 text-lg font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">New</span>
            @elseif ($group->status == 'pending')
                <span
                    class="bg-yellow-100 text-yellow-800 text-lg font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">Pending</span>
            @elseif ($group->status == 'confirmed')
                <span
                    class="bg-green-100 text-green-800 text-lg font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Confirmed</span>
            @endif
        </h5>
        
        {{-- Displaying Group Leader --}}
        @foreach ($users as $user)
            @if ($user->state == 'group_leader')
                <p class="mb-3 font-bold text-gray-700 dark:text-gray-400">Group Leader <span class="font-normal">{{ $user->name }}</span> </p>
            @endif
        @endforeach
        <hr class="p-1">
        {{-- Displaying Group Members --}}
        <p class="mb-3 font-bold text-gray-700 dark:text-gray-400">Group Members</p>
        @foreach ($users as $user)
            @if ($user->state == 'group_member')
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $user->name }}</p>
            @endif
        @endforeach
        <div class="flex items-center justify-end mt-4">
            <form action="{{ route('leaveGroup') }}" method="POST">
                @csrf
                <button class="btn btn-error">{{ __('Leave Group') }}</button>    
            </form>
        </div>
    </div>
</div>