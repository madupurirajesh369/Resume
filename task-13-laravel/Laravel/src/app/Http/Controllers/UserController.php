<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
            ]);
    
            User::create($request->all());
    
            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } 
        
        catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } 
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the user.');
        }
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
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
            ]);
    
            $user = User::find($id);
            if (!$user) {
                throw new ModelNotFoundException("User not found.");
            }
    
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->save();
    
            return redirect()->route('users.index');
        } 

        catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'User not found.');
        }
        catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } 
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the user.');
        }
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
