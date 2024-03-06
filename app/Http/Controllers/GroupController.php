<?php

namespace App\Http\Controllers;

use App\Actions\Group\CreateNewGroupAction;
use App\Dto\Group\CreateNewGroupDto;
use App\Http\Requests\CreateNewGroupRequest;
use App\Models\Group;
use App\Providers\RouteServiceProvider;
use App\States\StudentStates;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        $this->authorize('canCreateNewGroup', Group::class);

        return view('groups.groupform');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function CreateNewGroup(CreateNewGroupRequest $request, CreateNewGroupAction $createNewGroupAction)
    {
        $this->authorize('canCreateNewGroup', Group::class);
        $group = $createNewGroupAction->create(new CreateNewGroupDto(
            name: $request->name,
            department: auth()->user()->department,
            groupleaderId: auth()->id(),
        ));

        //Saving group id to user
        $user = auth()->user();
        $user->group_id = $group->id;
        $user->state = StudentStates::GroupLeader;
        $user->save();

        return redirect(RouteServiceProvider::HOME);
    }
}
