<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{__('app.groups')}}
        </h2>
    </x-slot>
    <div class="max-w-7xl mt-4 mx-auto sm:px-6 lg:px-8">
        @if (count($groups) <= 0)
            <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">No groups Available</h1>
        @else
        <div class="grid lg:grid-cols-3 gap-4 md:grid-cols-2 sm:grid-cols-1">
            @foreach ($groups as $group)
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    {{-- Displaying Group name and status --}}
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $group->name }}
                        @if ($group->status == 'new')
                            <span
                                class="bg-gray-100 text-gray-800 text-lg font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">{{__('app.new')}}</span>
                        @elseif ($group->status == 'pending')
                            <span
                                class="bg-yellow-100 text-yellow-800 text-lg font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">{{__('app.pending')}}</span>
                        @elseif ($group->status == 'confirmed')
                            <span
                                class="bg-green-100 text-green-800 text-lg font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{__('app.confirmed')}}</span>
                        @endif
                    </h5>
                    {{-- Displaying Group Leader --}}
                    @if ($group->user->contains('state', 'group_leader'))
                        <p class="mb-3 font-bold text-gray-700 dark:text-gray-400">{{ __('app.group_leader') }} <span class="font-normal">{{ $group->user->firstWhere('state', 'group_leader')->name }}</span></p>
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
                        <form action="{{ route('joingroup', ['group_id' => $group->id]) }}" method="POST">
                            @csrf
                            <button class="btn btn-neutral">{{ __('app.join') }}</button>   
                        </form> 
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>
</x-app-layout>
