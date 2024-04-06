<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('app.resources') }}
        </h2>
    </x-slot>
    <div class='mt-2 flex justify-center items-center'>
        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-xl text-gray-800 dark:text-gray-200">Name</th>
                        <th class="text-xl text-gray-800 dark:text-gray-200">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resources as $resource)
                        <tr>
                            
                            <th class="text-xl text-gray-800 dark:text-gray-200">{{$resource->id}}</th>
                            <td class="text-xl text-gray-800 hover:underline dark:text-gray-200"><a href="{{route('resources.show', $resource->id)}}">{{$resource->name}}</a></td>
                            <td class="text-xl text-gray-800 dark:text-gray-200">{{$resource->created_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>