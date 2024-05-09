@php
$user = auth()->user();
$announcements = App\Models\Announcement::where('department_id', $user->department_id)->latest()->take(3)->get();
@endphp

<div class="flex flex-col p-6">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{__('app.announcements')}}</h5>
        @foreach($announcements as $announcement)
            <a href="{{route('showannouncement', $announcement->id)}}">
                <h5 class="text-xl font-bold text-gray-700 dark:text-gray-400">{{ $announcement->header }}</h5>
                <p class="text-gray-700 dark:text-gray-400">{{ Str::limit($announcement->brief, 50) }}</p>
            </a>
        @endforeach
</div>