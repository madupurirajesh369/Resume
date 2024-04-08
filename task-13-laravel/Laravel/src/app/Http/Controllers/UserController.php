<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::paginate(5);

        return view('users.index',compact('users'))
            ->with(request()->input('page'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        User::create($request->all());
        return redirect()->route('users.index')
                        ->with('success','User created successfully.');
    }

    public function show($id)
    {
        $user = User::find($id);
        return response($user);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->save();
        return to_route('users.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user === null) {
            return response()->json(['error' => 'Not Found'], 404);
        }
        $user->delete();
        return to_route('users.index');
    }
}
