<?php

namespace App\Dto\Group;

readonly class CreateNewGroupDto
{
    public function __construct(
        public string $name,
        public string $department,
        public int $groupleaderId,
    ) {
    }
}
