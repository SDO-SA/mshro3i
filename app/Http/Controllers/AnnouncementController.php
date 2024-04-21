<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function show($announcement_id)
    {
        $announcement = Announcement::find($announcement_id);

        return view('announcements.show', compact('announcement'));
    }
}
