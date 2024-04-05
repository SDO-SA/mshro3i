<x-app-layout>
    <div class='mt-2 flex justify-between items-center'>
        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resources as $resource)
                        <tr>
                            
                            <th>{{$resource->id}}</th>
                            <td><a href="{{route('resources.show', $resource->id)}}">{{$resource->name}}</a></td>
                            <td>{{$resource->created_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>