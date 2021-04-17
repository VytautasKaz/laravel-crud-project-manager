<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects', ['projects' => Project::all()]);
    }

    public function show($id)
    {
        return view('project', ['project' => Project::find($id)]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'new_project' => 'required|max:32'
        ]);

        $newProj = new Project();
        $newProj->title = $request['new_project'];
        // if ($newBp->title === NULL or $newBp->content === NULL) {
        //     return redirect('/posts')->with('status_error', 'Post creation failed.');
        // }
        return ($newProj->save() == 1)
            ? redirect('/projects')->with('status_success', 'Employee added successfully!')
            : redirect('/projects')->with('status_error', 'Employee addition failed.');
    }

    public function destroy($id)
    {
        Project::destroy($id);
        return redirect('/projects')->with('status_success', 'Project deleted!');
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'upd_title' => 'required|max:32',
        ]);
        $up_proj = Project::find($id);
        $up_proj->title = $request['upd_title'];
        return ($up_proj->save() == 1) ?
            redirect('/projects')->with('status_success', 'Project info updated!') :
            redirect('/projects')->with('status_error', 'Project update failed.');
    }
}
