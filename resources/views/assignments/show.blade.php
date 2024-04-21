<x-app-layout>
    <article class="col-span-4 md:col-span-3 mt-10 mx-auto py-5 w-full" style="max-width:700px">
        <h1 class="text-4xl font-bold text-right text-gray-800">
            {{$assignment->name}}
        </h1>
        <div class="mt-2 flex justify-between items-center">
            <div class="flex py-5 text-base items-center">
                <h3 class='font-bold'>{{$assignment->department_id}}</h3>
            </div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.3"
                    stroke="currentColor" class="w-5 h-5 text-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-gray-500 mr-2">{{ $assignment->created_at->diffForHumans() }}</span>  
            </div>
        </div>

        <div class="article-content py-3 text-gray-800 text-lg text-justify">
            {!! $assignment->deliverables !!}
        </div>
    </article>
</x-app-layout>