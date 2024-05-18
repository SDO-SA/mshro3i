<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Create and show Project Form
    public function createForm()
    {
        $this->authorize('canCreateProjectProposal', Project::class);

        return view('projects.project-form');
    }

    // Create Project and store it in Database

    public function createProject(Request $request)
    {
        $this->authorize('canCreateProjectProposal', Project::class);
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'abstract' => 'required|string|max:255',
            'projectfield' => 'required|array',
            'projectfield.*' => 'string',
            'projecttech' => 'required|string|max:255',
            'attachment' => 'required|file|mimes:pdf|max:102400',
        ]);

        $attachmentPath = $request->file('attachment')->store('public');

        Project::create([
            'name' => $request->name,
            'department_id' => $user->department_id,
            'supervisor_id' => $user->group->supervisor_id,
            'group_id' => $user->group_id,
            'abstract' => $request->abstract,
            'projectfield' => implode(' , ', $request->projectfield),
            'projecttech' => $request->projecttech,
            'attachment' => $attachmentPath,
            'status' => 'pending',
        ]);
        $notification = [
            'message' => __('app.alert_create_project'),
            'alert-type' => 'success',
        ];

        return redirect(RouteServiceProvider::HOME)->with($notification);
    }

    // Create and show Project Update Form

    public function updateForm($project_id)
    {
        $this->authorize('canUpdateProjectInfo', Project::class);
        $project = Project::findOrFail($project_id);

        return view('projects.update-project', compact('project'));
    }

    // Update Project Function

    public function updateproject(Request $request, $project_id)
    {
        $this->authorize('canUpdateProjectInfo', Project::class);

        $user = auth()->user();

        $project = Project::findOrFail($project_id);

        $attachmentPath = $request->file('attachment')->store('public');

        $project->update([
            'name' => $request->name,
            'department_id' => $user->department_id,
            'supervisor_id' => $user->group->supervisor_id,
            'group_id' => $user->group_id,
            'abstract' => $request->abstract,
            'projectfield' => implode(' , ', $request->projectfield),
            'projecttech' => $request->projecttech,
            'feedback' => null,
            'attachment' => $attachmentPath,
            'status' => 'pending',
        ]);

        $notification = [
            'message' => __('app.alert_update_project'),
            'alert-type' => 'success',
        ];

        return redirect(RouteServiceProvider::HOME)->with($notification);
    }
}
