<?php

namespace App\Http\Controllers;

use App\Actions\Group\CreateNewGroupAction;
use App\Dto\Group\CreateNewGroupDto;
use App\Http\Requests\CreateNewGroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        return view('groups.groupform');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function CreateNewGroup(CreateNewGroupRequest $request, CreateNewGroupAction $createNewGroupAction): JsonResponse
    {
        // $this->authorize('canCreateNewGroup', Group::class);
        $group = $createNewGroupAction->create(new CreateNewGroupDto(
            name: $request->name,
            supervisor: $request->supervisor,
            department: auth()->user()->department,
            groupleaderId: auth()->id(),
        ));

        redirect(RouteServiceProvider::HOME);

        return response()->json([
            'message' => 'group created successfully',
            'data' => new GroupResource($group),
        ]);
    }
}
