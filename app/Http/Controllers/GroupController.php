<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupResource;
use App\Models\Department;
use App\Models\Group;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\States\GroupStatues;
use App\States\StudentStates;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        $this->authorize('canCreateNewGroup', Group::class);
        $userId = auth()->user()->id;
        $groupMembers = User::where('department_id', auth()->user()->department_id)
            ->where('id', '!=', $userId)
            ->where('state', StudentStates::NotJoined)
            ->pluck('name', 'id');

        return view('groups.groupform', ['groupMembers' => $groupMembers]);
    }

    public function list()
    {
        $this->authorize('canCreateNewGroup', Group::class);
        $groups = Group::where('department_id', auth()->user()->department_id)
            ->where('total_members', '<', 4)
            ->get();

        return view('groups.group-list', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function CreateNewGroup(Request $request)
    {
        $this->authorize('canCreateNewGroup', Group::class);
        $user = auth()->user();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $group = Group::create([
            'name' => $request->name,
            'department_id' => Department::find($user->department_id)->id,
            'total_members' => 1,
            'status' => GroupStatues::New,
        ]);

        //Saving group id to group leader
        User::where('id', $user->id)
            ->update([
                'state' => StudentStates::GroupLeader,
                'group_id' => $group->id,
            ]);

        $gmbid = $request->groupmembers;

        User::whereIn('id', $gmbid)
            ->update([
                'state' => StudentStates::GroupMember,
                'group_id' => $group->id,
            ]);

        $group->total_members = $group->total_members + count($gmbid);
        if ($group->total_members == 4) {
            $group->status = GroupStatues::Pending;
        }
        $group->save();

        return redirect(RouteServiceProvider::HOME);
    }

    public function join($group_id)
    {
        $user = auth()->user();
        $group = Group::find($group_id);

        if ($group) {
            $user->state = StudentStates::GroupMember;
            $user->group_id = $group->id;
            $user->save();

            $group->increment('total_members');
        }
        if ($group->total_members == 4) {
            $group->status = GroupStatues::Pending;
            $group->save();
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
            'my_role' => $user->state,
            'my-group' => new GroupResource($group),
        ]);
    }
}
