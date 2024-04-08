<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Host;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project=Project::all();
        return response($project);

       /*$projects = Project::paginate(5);

        return view('projects.index',compact('projects'))
            ->with(request()->input('page'));*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       /* $project=new Project();
        $project->title="rajeshproject";
        $project->status="ongoing";
        $project->save();
        return response()->json(["string created"]);*/
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /* $project = new Project;
        $project->user_id = $request->get('user_id');
        $project->title = $request->get('title');
        $project->status = $request->get('status');
        $project->save();
        return response()->json(['string created']);*/

        $request->validate([
            'user_id'=>'required',
            'title' => 'required',
            'status' => 'required',
        ]);

        $project = new Project;
        $project->user_id = $request->get('user_id');
        $project->title = $request->get('title');
        $project->status = $request->get('status');
        $project->save();

        return redirect()->route('projects.show',$project->user_id)
                        ->with('success','User created successfully.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $user = Host::find($user_id);
        $project1=[];
        foreach ($user->projects as $project)
        {
            array_push($project1, $project);
        }
        return view('projects.index',compact('project1','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
        ]);

        $project = Project::findOrFail($id);
        $project->title = $request->title;
        $project->status = $request->status;
        $project->save();

        return redirect()->route('projects.show',$project->user_id)->with('success', 'Project updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project1)
    {
        $project = Project::find($project1); // Assuming Project is your model
        if($project) {
            $project->delete();
            return redirect()->route('projects.show',$project->user_id)->with('success', 'Project deleted successfully');
        } else {
            return redirect()->route('hosts.show', ['user_id' => $project->host_id])->with('error', 'Project not found');
        }
        
    }
}
