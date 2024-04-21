<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('app.assignments') }}
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
                    @foreach($assignments as $assignment)
                        <tr>
                            
                            <th class="text-xl text-gray-800 dark:text-gray-200">{{$assignment->id}}</th>
                            <td class="text-xl text-gray-800 hover:underline dark:text-gray-200"><a href="{{route('assignments.show', $assignment->id)}}">{{$assignment->name}}</a></td>
                            <td class="text-xl text-gray-800 dark:text-gray-200">{{$assignment->created_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>