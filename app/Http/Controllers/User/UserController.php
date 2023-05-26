<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\{User, Role};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $users = User::orderBy('name','asc')->get();
      return view('users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $roles = Role::orderBy('name','asc')->get();
      return view('users.create')->with('roles',$roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
      ]);

      $user           = new User;
      $user->name     = $request->name;
      $user->email    = $request->email;
      $user->role_id  = $request->role_id;
      $user->password = Hash::make($request->password);
      $user->save();

      // return redirect('users');
      return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
      $mentionedUser = User::findOrFail($user->id);
      return view('users.edit')->with('user',$mentionedUser);        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {   
      $request->validate([
          'name' => 'required|string|max:255',
          'email' => "required|string|max:255|email|unique:users,email," . $user->id,
          'password' => "required|string|min:6|confirmed"
      ]);

      $user           = User::findOrFail($user->id);
      $user->name     = $request->name;
      $user->email    = $request->email;
      $user->role_id  = $request->role_id;
      $user->password = Hash::make($request->password);
      $user->save();

      // return redirect('users');    
      return redirect()->route('users.index');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
