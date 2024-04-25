<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function form($assignment_id)
    {
        $assignment = Assignment::find($assignment_id);

        return view('assignments.submit-form', compact('assignment'));
    }

    public function submit(Request $request, $assignment_id)
    {
        // $this->authorize('canSubmitAssignment', Submission::class);
        $user = auth()->user();
        $assignment = Assignment::find($assignment_id);

        $attachmentPath = $request->file('attachment')->store('public');

        Submission::create([
            'name' => $assignment->name,
            'status' => 'pending',
            'notes' => $request->notes,
            'submitter' => $user->name,
            'assignment_id' => $assignment->id,
            'department_id' => $user->department_id,
            'group_id' => $user->group_id,
            'supervisor_id' => $user->group->supervisor_id,
            'attachment' => $attachmentPath,
        ]);
        $notification = [
            'message' => __('تم تسليم الواجب'),
            'alert-type' => 'success',
        ];

        return redirect(RouteServiceProvider::HOME)->with($notification);
    }
}
