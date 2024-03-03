<?php

namespace App\Actions\Group;

use App\Dto\Group\CreateNewGroupDto;
use App\Models\Group;


class CreateNewGroupAction
{
    private Group $group;

    public function create(CreateNewGroupDto $createNewGroupDto): Group
    {
        $this->group = new Group();

        $this->fillGroupData($createNewGroupDto);
        $this->group->save();

        return $this->group;
    }

    public function fillGroupData(CreateNewGroupDto $createNewGroupDto): void
    {
        $this->group->name = $createNewGroupDto->name;
        $this->group->department = $createNewGroupDto->department;
        $this->group->supervisor = $createNewGroupDto->supervisor;
        $this->group->groupleaderId = $createNewGroupDto->groupleaderId;
        
    }
}
