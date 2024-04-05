@php
$user = auth()->user();
$announcements = App\Models\Announcement::where('department_id', $user->department_id)->latest()->take(3)->get();
@endphp

<div class="flex items-center justify-center p-6">
    <div class="max-w-sm p-6 min-w-96 min-h-max bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{__('app.announcements')}}</h5>
        @foreach($announcements as $announcement)
            <a href="{{route('showannouncement', $announcement->id)}}">
                <h5 class="text-xl font-bold">{{ $announcement->header }}</h5>
                <p>{{ Str::limit($announcement->message, 95) }}</p>
            </a>
        @endforeach
    </div>
</div>