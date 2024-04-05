<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Department;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function show($announcement_id)
    {
        $announcement = Announcement::find($announcement_id);
        $department = Department::find($announcement->department_id);
        return view("announcements.show", compact('announcement', 'department'));
    }
}
