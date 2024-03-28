<?php

namespace App\Http\Controllers;
use App\Models\Host;

use Illuminate\Http\Request;

class GetProjectController extends Controller
{
    public function getProjects($user_id)
    {
        $user = Host::find($user_id);
        $project_array = [];
        if ($user === null) {
            return response()->json(['error' => 'Not Found'], 404);
        } else {
            foreach ($user->projects as $project) {
                array_push($project_array, $project);
            }
            return response()->json($project_array);
        }
    }
}



//Route::get('/host/user/{user_id}/projects', 'App\Http\Controllers\GetProjectController@getProjects');