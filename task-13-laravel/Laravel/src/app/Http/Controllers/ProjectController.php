<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(5);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'title' => 'required',
                'status' => 'required',
            ]);
    
            $project = new Project;
            $project->user_id = $request->get('user_id');
            $project->title = $request->get('title');
            $project->status = $request->get('status');
            $project->save();
    
            return redirect()->route('projects.show', $project->user_id)
                ->with('success', 'Project created successfully.');
        } 
        
        catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } 
        
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while saving the project.');
        }
    }
    
    public function show($user_id)
    {
        $user = User::find($user_id);
        $projects = $user->projects()->paginate(5);

        return view('projects.show',compact('projects','user'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required',
                'status' => 'required',
            ]);
    
            $project = Project::findOrFail($id);
            $project->title = $request->title;
            $project->status = $request->status;
            $project->save();
    
            return redirect()->route('projects.show', $project->user_id)->with('success', 'Project updated successfully');
        }

        catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } 
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the project.');
        }
    }

    public function destroy($project1)
    {
        $project = Project::find($project1); // Assuming Project is your model
        if($project) {
            $project->delete();
            return redirect()->route('projects.show',$project->user_id)->with('success', 'Project deleted successfully');
        }
        
    }
}
