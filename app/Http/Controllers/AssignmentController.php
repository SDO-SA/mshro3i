<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $assignments = Assignment::where('department_id', $user->department_id)->get();
        return view('assignments.index', compact('assignments'));
    }

    public function show($assignment_id)
    {
        $assignment = Assignment::findOrFail($assignment_id);

        return view('assignments.show', compact('assignment'));
    }
}
