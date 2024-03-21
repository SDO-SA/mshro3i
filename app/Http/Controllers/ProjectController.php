<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function createForm()
    {
        // $this->authorize('canCreateProjectProposal', Project::class);

        return view('projects.project-form');
    }

    public function createProject(Request $request)
    {
        $this->authorize('canCreateProjectProposal', Project::class);
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'abstract' => 'required|string|max:255',
            'projectfield' => 'required|array',
            'projectfield.*' => 'string',
            'attachment' => 'required|file|mimes:pdf|max:2048',
        ]);

        $attachmentPath = $request->file('attachment')->store('attachments');

        Project::create([
            'name' => $request->name,
            'department_id' => $user->department_id,
            'group_id' => $user->group_id,
            'abstract' => $request->abstract,
            'projectfield' => implode(',', $request->projectfield),
            'attachment' => $attachmentPath,
            'status' => 'pending',
        ]);

        return redirect(RouteServiceProvider::HOME);
    }
}