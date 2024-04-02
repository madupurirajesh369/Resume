<?php

namespace App\Http\Controllers;

use App\Models\Host;
use Illuminate\Http\Request;

class HostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /* $host=Host::all();
        return response($host); */

        $hosts = Host::paginate(5);

        return view('users.index',compact('hosts'))
            ->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$user=new Host();
        $user->name="rajesh";
        $user->email="rajesh@gmail.com";
        $user->save();
        return response()->json(["string created"]);*/
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /* $host = new Host;
        $host->name = $request->get('name');
        $host->email = $request->get('email');
        $host->save();
        return response()->json(['string created']);*/

        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        Host::create($request->all());

        return redirect()->route('users.index')
                        ->with('success','User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Host::find($id);
        return response($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Host::find($id);

        return view('user.edit', compact('user'));
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
            'name' => 'required',
            'email' => 'required',
        ]);
        $user = Host::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->save();
        return to_route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $host = Host::find($id);
        if ($host === null) {
            return response()->json(['error' => 'Not Found'], 404);
        }
        $host->delete();
        return to_route('users.index');
    }
}
