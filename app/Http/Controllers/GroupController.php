<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupResource;
use App\Models\Department;
use App\Models\Group;
use App\Models\Supervisor;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\States\GroupStatues;
use App\States\StudentStates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function createForm()
    {
        $this->authorize('canCreateNewGroup', Group::class);
        $user = auth()->user();

        $groupMembers = User::where('department_id', $user->department_id)
            ->where('id', '!=', $user->id)
            ->where('state', StudentStates::NotJoined)
            ->get();

        $supervisors = Supervisor::where('department_id', $user->department_id)
            ->pluck('name', 'id');

        return view('groups.groupform', compact('groupMembers', 'supervisors'));
    }

    public function list()
    {
        $this->authorize('canCreateNewGroup', Group::class);
        $groups = Group::where('department_id', auth()->user()->department_id)
            ->orderBy('total_members', 'asc')
            ->get();

        return view('groups.group-list', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createNewGroup(Request $request)
    {
        $this->authorize('canCreateNewGroup', Group::class);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($request) {
            $user = auth()->user();
            $group = Group::create([
                'name' => $request->name,
                'department_id' => Department::find($user->department_id)->id,
                'total_members' => 1,
                'status' => GroupStatues::New ,
                'supervisors' => implode(',', $request->supervisor),
            ]);

            // Group::where('id', $group->id)
            //     ->update(['supervisor_id' => $request->supervisor]);

            User::where('id', $user->id)
                ->update([
                    'state' => StudentStates::GroupLeader,
                    'group_id' => $group->id,
                ]);

            $validMembers = is_array($request->groupmembers) ? array_filter($request->groupmembers) : [];
            if (!empty ($validMembers)) {
                $group->total_members = $group->total_members + count($validMembers);
                if ($group->total_members >= 4) {
                    $group->status = GroupStatues::Pending;
                }
                $group->save();

                User::whereIn('id', $validMembers)
                    ->update([
                        'state' => StudentStates::GroupMember,
                        'group_id' => $group->id,
                    ]);
            }
        });

        return redirect(RouteServiceProvider::HOME);
    }

    public function joinGroup($group_id)
    {
        $this->authorize('canJoinGroup', Group::class);

        $user = auth()->user();
        $group = Group::find($group_id);

        if ($group) {
            if ($group->total_members >= 4) {
                abort(403, 'Unauthorized');
            }

            $user->update([
                'state' => StudentStates::GroupMember,
            ]);
            $user->group_id = $group->id;
            $user->save();

            $group->increment('total_members');

            if ($group->total_members == 4) {
                $group->update(['status' => GroupStatues::Pending]);
            }
        }

        return redirect(RouteServiceProvider::HOME);
    }

    public function leaveGroup()
    {
        $user = auth()->user();
        $group = Group::find($user->group_id);

        if ($group) {
            if ($user->state === StudentStates::GroupLeader()->value) {
                if ($group->total_members === 1) {
                    $user->group_id = null;
                    $user->save();
                    $group->delete();
                } else {
                    $newLeader = User::where('group_id', $user->group_id)
                        ->where('id', '!=', $user->id)
                        ->first();

                    if ($newLeader) {
                        $newLeader->state = StudentStates::GroupLeader;
                        $newLeader->save();
                    }
                }
            }

            User::where('id', $user->id)
                ->update([
                    'state' => StudentStates::NotJoined,
                    'group_id' => null,
                ]);

            $group = Group::find($group->id);

            if ($group != null) {
                $group->decrement('total_members');

                if ($group->total_members < 4) {
                    $group->update(['status' => GroupStatues::New]);
                }
            }
        }

        return redirect(RouteServiceProvider::HOME);
    }

    public function show(Request $request)
    {
        $this->authorize('canShowMyGroup', Group::class);
        $user = auth()->user();
        $group = Group::find($user->group_id);

        return response()->json([
            'message' => '200',
            'role' => $user->state,
            'my-group' => new GroupResource($group),
        ]);
    }
}
