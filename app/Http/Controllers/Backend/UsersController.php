<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserDestroyRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;

class UsersController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(5);
        return view('backend.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('backend.users.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $user->attachRole($data->role);
        return redirect(route('users.index'))->with('message','User Added SuccessFully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        $user->detachRoles();
        $user->attachRole($request->role);
        return redirect(route('users.index'))->with('message','User Updated SuccessFully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDestroyRequest $request ,  $id)
    {
        $deleteOption = $request->delete_option;
        $selectedUser = $request->selected_user;
        $user = User::findOrFail($id);

        if ($deleteOption == 'delete') {
            //Delete User Post
            $user->posts()->withTrashed()->forceDelete();

        }
        elseif ($deleteOption == 'attribute') {
            $user->posts()->update(['user_id' => $selectedUser]);
        }


        $user->delete();
        return redirect(route('users.index'))->with('message','User Deleted SuccessFully');
    }

    public function confirm(UserDestroyRequest $request ,  $id)
    {
        $user = User::findOrFail($id);
        $users = User::where('id' , '!=' ,$user->id)->pluck('name','id');
        return view('backend.users.confirm',compact('user','users'));
    }
}
