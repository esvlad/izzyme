<?php

namespace App\Http\Controllers\Admin\UserManagment;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.user_managment.users.index', [
          'users' => User::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.user_managment.users.create', [
        'roles' => Role::all(),
        'auth_role' => Role::user_role(Auth::id())
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = $this->validate($request, [
          'name' => 'required|max:255',
          'email' => 'required|email|max:255|unique:users',
          'password' => 'required|min:6|confirmed',
      ]);

      $user = User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => bcrypt($request['password']),
        'status' => $request['status']
      ]);

      Role::user_role_save($user->id, $request['roles_users']);

      return redirect()->route('admin.user_managment.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user_managment.users.edit', [
          'user' => $user,
          'roles' => Role::all(),
          'user_role' => Role::user_role($user->id),
          'auth_role' => Role::user_role(Auth::id())
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      $validator = $this->validate($request, [
          'name' => 'required|max:255',
          'email' => [
            'required',
            'string',
            'email',
            'max:255',
            \Illuminate\Validation\Rule::unique('users')->ignore($user->id),
          ],
          'password' => 'nullable|string|min:6|confirmed',
      ]);

      $user->name = $request['name'];
      $user->email = $request['email'];
      $user->status = $request['status'];
      $request['password'] == null ?: $user->password = bcrypt($request['password']);
      $user->save();

      Role::user_role_update($user->id, $request['roles_users']);

      return redirect()->route('admin.user_managment.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Role::user_role_delete($user->id);
        $user->delete();

        return redirect()->route('admin.user_managment.user.index');
    }
}
