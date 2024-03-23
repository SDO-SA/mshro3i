<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function getDepartment(Request $request, $college)
    {
        $departments = Department::where('college_id', $college)->pluck('name_ar', 'id');

        return response()->json($departments);
    }
}
