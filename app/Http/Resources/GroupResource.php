<?php

namespace App\Http\Resources;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'department' => Department::find($this->department_id)->department,
            'total_members' => $this->total_members,
            'status' => $this->status,
        ];
    }
}
