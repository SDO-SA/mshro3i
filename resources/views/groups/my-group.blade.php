@php
    $user = auth()->user();
    if ($user->state !== 'not_joined') {
        $group = App\Models\Group::find($user->group_id);
        $users = App\Models\User::where('group_id', $group->id)->get();
    }
@endphp
<div class="flex items-center justify-center h-64">
    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$group->name}}</h5>
        @foreach ($users as $user)
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$user->name}}&nbsp;{{$user->state}}</p>
        @endforeach
    </div>
</div>