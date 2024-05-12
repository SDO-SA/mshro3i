<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('app.resources') }}
        </h2>
    </x-slot>
    @if (count($resources) <= 0)
            <div class="flex flex-col items-center justify-center h-auto">
                <img src="{{ asset('img/File-searching.svg') }}" alt="" class="lg:w-[500px] lg:h-[500px] sm:w-[250px] sm:h-[250px]">
                <h1 class="font-semibold text-2xl text-gray-800 sm:text-4xl dark:text-gray-200 leading-tight">{{__('app.no_resources_available')}}</h1>
            </div>
    @else
    <div class='mt-7 flex justify-center items-center'>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-[80rem]">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <!-- head -->
                <thead class="text-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col">&nbsp;</th>
                        <th scope="col" class="px-2 py-3">الأسم</th>
                        <th scope="col" class="px-2 py-3">تاريخ الإنشاء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resources as $resource)
                        <tr class="bg-white text-base border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            
                            <th scope="row" class="pr-6 font-medium text-gray-900 whitespace-nowrap dark:text-white"></th>
                            <td class="px-2 py-4"><a href="{{route('resources.show', $resource->id)}}">{{$resource->name}}</a></td>
                            <td class="px-2 py-4">{{$resource->created_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</x-app-layout>