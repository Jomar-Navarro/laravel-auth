<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Functions\Helper as Help;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.Projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $exist = Project::where('title', $request->title)->first();
        if ($exist) {
            return redirect()->route('admin.projects.index')->with('error', 'Project already exist!');
        }else {
            $new = new Project();
            $new->title = $request->title;
            $new->slug = Help::generateSlug($new->title, Project::class);
            $new->save();

            return redirect()->route('admin.projects.index')->with('success', 'Project added successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $val_data = $request->validate([
            'title' => 'required|min:2|max:20',
            // 'description' => 'required',
            // 'project_url' => 'required|url',
            // 'completion_date' => 'required|date',
        ],
        [
            'title.required' => 'Name of the project is required.',
            'title.min' => 'The project name should have at least 2 characters.',
            'title.max' => 'The project name should have a maximum of 20 characters.',
            // 'description.required' => 'Description is required.',
            // 'project_url.required' => 'Project URL is required.',
            // 'project_url.url' => 'Project URL should be a valid URL.',
            // 'completion_date.required' => 'Completion date is required.',
            // 'completion_date.date' => 'Completion date should be a valid date.',
        ]);

        $exist = Project::where('title', $request->title)->first();
        if ($exist) {
            return redirect()->route('admin.projects.index')->with('error', 'Project already exist!');
        }else {
            $val_data['slug'] = Help::generateSlug($request->title, Project::class);
            $project->update($val_data);

            return redirect()->route('admin.projects.index')->with('success', 'Project modified successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

            return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully!');

    }
}
