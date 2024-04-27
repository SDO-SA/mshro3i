@php
    $user = auth()->user();
    $group = $user->state !== 'not_joined' ? $user->group : null;
@endphp
<div class="p-6">

    {{-- Displaying Group name and status --}}
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $user->group->name }}
        @if ($user->group->status == 'new')
            <span
                class="bg-gray-100 text-gray-800 text-lg font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">{{ __('app.new') }}</span>
        @elseif ($user->group->status == 'pending')
            <span
                class="bg-yellow-100 text-yellow-800 text-lg font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">{{ __('app.pending') }}</span>
        @elseif ($user->group->status == 'confirmed')
            <span
                class="bg-green-100 text-green-800 text-lg font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{ __('app.confirmed') }}</span>
        @endif
    </h5>

    {{-- Displaying Supervisor --}}
    <p class="mb-3 font-bold text-gray-700 dark:text-gray-400">
        {{ __('app.group_supervisor') }}
        <span class="font-normal">
            {{ $group->supervisor->name ?? __('app.no_supervisor') }}
        </span>
    </p>

    {{-- Displaying Group Leader --}}
    @if ($group->user->contains('state', 'group_leader'))
        <p class="mb-3 font-bold text-gray-700 dark:text-gray-400">{{ __('app.group_leader') }} <span
                class="font-normal">{{ $group->user->firstWhere('state', 'group_leader')->name }}</span></p>
    @endif
    <hr class="p-1">
    {{-- Displaying Group Members --}}
    <p class="mb-3 font-bold text-gray-700 dark:text-gray-400">{{ __('app.group_members') }}</p>
    @foreach ($group->user->where('state', 'group_member') as $user)
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $user->name }}</p>
    @endforeach

    @if ($group->status == 'confirmed')
    @else
        <div class="flex justify-end">
            <button class="btn btn-error" onclick="my_modal_1.showModal()">{{ __('app.leave_group') }}</button>  
        </div>
        
        <dialog id="my_modal_1" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg">{{__('app.alert_warning')}}</h3>
                <p class="py-4">{{ __('app.alert_leaving_warning') }}</p>
                <div class="modal-action">
                    <form method="dialog">
                        <!-- if there is a button in form, it will close the modal -->
                        <button class="btn">{{ __('app.alert_cancel_button') }}</button>
                        <button class="btn btn-error" type="submit" form="leave-group">{{ __('app.alert_leave_button') }}</button>
                    </form>
                </div>
            </div>
        </dialog>
        <form id="leave-group" action="{{ route('leaveGroup') }}" method="POST">
            @csrf
        </form>
    @endif
</div>
