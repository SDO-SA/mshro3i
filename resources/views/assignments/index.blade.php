<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('app.assignments') }}
        </h2>
    </x-slot>
    <div class='mt-7 flex justify-center items-center'>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-[80rem]">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <!-- head -->
                <thead class="text-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col">&nbsp;&nbsp;</th>
                        <th scope="col" class="px-2 py-3">{{ __('app.name') }}</th>
                        <th scope="col" class="px-2 py-3">{{ __('app.points') }}</th>
                        <th scope="col" class="px-2 py-3">{{ __('app.created_at') }}</th>
                        <th scope="col">&nbsp;&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assignments as $assignment)
                        <tr class="bg-white text-base border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            
                            <th scope="row" class="pr-6 font-medium text-gray-900 whitespace-nowrap dark:text-white"></th>
                            <td class="px-2 py-4"><a href="{{route('assignments.show', $assignment->id)}}">{{$assignment->name}}</a></td>
                            <td class="px-2 py-4">{{$assignment->points}}</td>
                            <td class="px-2 py-4">{{$assignment->created_at->diffForHumans()}}</td>
                            @if (auth()->user()->state === 'group_leader')
                                <td class="px-2 py-4"><a href="{{route('assignments.form', $assignment->id)}}">تسليم</a></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>