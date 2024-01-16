<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        $slug = Str::slug($data['title'], '-');

        $data['slug'] = $slug;
        if ($request->hasFile('image')) {
            $path = Storage::put('uploads', $request->image);
            $data['image'] = $path;
        }

        $newProject = Project::create($data);
        return redirect()->route('admin.projects.show', ['project' => $newProject->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        if ($project->title !== $data['title']) {
            $slug = Project::getSlug($data['title'], '-');
        } else {
            $slug = $project->slug;
        }
        $data['slug'] = $slug;
        if ($request->hasFile('image')) {
            if (Storage::exists($project->image)) {
                Storage::delete($project->image);
            }
            $path = Storage::put('images', $request->image);
            $data['image'] = $path;
        }
        $project->update($data);
        return redirect()->route('admin.projects.show', ['project' => $project->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "Il progetto $project->title è stato eliminato con successo");
    }
}
