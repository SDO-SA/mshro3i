<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupResource;
use App\Models\Department;
use App\Models\Group;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
            ->pluck('name', 'id');

        return view('groups.groupform', ['groupMembers' => $groupMembers]);
    }

    public function list()
    {
        $groups = Group::where('department_id', auth()->user()->department_id)->get();

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
        ]);

        //Saving group id to group leader
        $user->group_id = $group->id;
        $user->state = StudentStates::GroupLeader;
        $user->save();

        $gmbid = $request->groupmembers;
        foreach ($gmbid as $mid) {
            $groupMember = User::find($mid);
            if ($groupMember) {
                $groupMember->state = StudentStates::GroupMember;
                $groupMember->group_id = $group->id;
                $groupMember->save();
            }
        }

        return redirect(RouteServiceProvider::HOME);
    }

    public function show(Request $request)
    {
        // $this->authorize('canShowMyGroup', Group::class);
        $user = auth()->user();
        $group = Group::find($user->group_id);

        return response()->json([
            'message' => '200',
            'my_role' => $user->state,
            'my-group' => new GroupResource($group),
        ]);
    }

    public function join($group_id)
    {
        $user = auth()->user();
        $user->group_id = $group_id;
        $user->state = StudentStates::GroupMember();
        $user->save();

        return redirect(RouteServiceProvider::HOME);
    }
}
