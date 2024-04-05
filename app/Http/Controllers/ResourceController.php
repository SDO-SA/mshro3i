<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $resources = Resource::where('department_id', $user->department_id)->get();
        return view('resources.index', compact('resources'));
    }

    public function show($resource_id)
    {
        $resource = Resource::findOrFail($resource_id);

        $pdfurl = Storage::url($resource->path);

        return view('resources.show', compact('pdfurl'));
    }
}
