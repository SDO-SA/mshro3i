<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb">
            {{ __('app.groups') }}
        </h2>
    </x-slot>
    @if (count($groups) <= 0)
            <div class="flex flex-col items-center justify-center ">
                <img src="{{ asset('img/nogroups.svg') }}" alt="" class="lg:w-[650px] lg:h-[650px] sm:w-[400px] sm:h-[400px]">
                <h1 class="font-semibold text-2xl text-gray-800 sm:text-4xl dark:text-gray-200 leading-tight">{{__('app.no_groups_available')}}</h1>
            </div>
    @else
        <div class="max-w-7xl mt-4 mx-auto sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-4 md:grid-cols-2 sm:grid-cols-1">
                @foreach ($groups as $group)
                    <div
                        class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        {{-- Displaying Group name and status --}}
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $group->name }}
                            @if ($group->status == 'new')
                                <span
                                    class="bg-gray-100 text-gray-800 text-lg font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">{{ __('app.new') }}</span>
                            @elseif ($group->status == 'pending')
                                <span
                                    class="bg-yellow-100 text-yellow-800 text-lg font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">{{ __('app.pending') }}</span>
                            @elseif ($group->status == 'confirmed')
                                <span
                                    class="bg-green-100 text-green-800 text-lg font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{ __('app.confirmed') }}</span>
                            @endif
                        </h5>
                        {{-- Displaying Group Leader --}}
                        @if ($group->user->contains('state', 'group_leader'))
                            <p class="mb-3 font-bold text-gray-700 dark:text-gray-400">{{ __('app.group_leader') }}
                                <span
                                    class="font-normal">{{ $group->user->firstWhere('state', 'group_leader')->name }}</span>
                            </p>
                        @endif
                        <hr class="p-1">
                        {{-- Displaying Group Members --}}
                        <p class="mb-3 font-bold text-gray-700 dark:text-gray-400">{{ __('app.group_members') }}</p>
                        @foreach ($group->user->where('state', 'group_member') as $user)
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $user->name }}</p>
                        @endforeach
                        <div class="flex items-center justify-end mt-4">
                            @if ($group->total_members >= 4)
                            @else
                                <x-primary-button class="h-12"
                                    onclick="my_modal_{{ $group->id }}.showModal()">{{ __('app.join') }}</x-primary-button>
                                <dialog id="my_modal_{{ $group->id }}" class="modal">
                                    <div class="modal-box">
                                        <h3 class="font-bold text-lg">{{__('app.alert_confirmation')}}!</h3>
                                        <p class="py-4">{{ __('app.alert_join_confirmation') }} {{ $group->name }}</p>
                                        <div class="modal-action">
                                            <form method="dialog">
                                                <!-- if there is a button in form, it will close the modal -->
                                                <button class="btn">{{ __('app.alert_cancel_button') }}</button>
                                                <x-primary-button class="h-12" type="submit"
                                                    form="join-group-{{ $group->id }}">{{ __('app.join') }}</x-primary-button>
                                            </form>
                                        </div>
                                    </div>
                                </dialog>
                                <form id="join-group-{{ $group->id }}" action="{{ route('joingroup', ['group_id' => $group->id]) }}"
                                    method="POST">
                                    @csrf
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</x-app-layout>
