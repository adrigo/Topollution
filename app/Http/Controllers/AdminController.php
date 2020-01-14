<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Device;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Contact::all();
        $devices = Device::all();
        $users = User::all();
        return view('admin.index')->with(['users' => $users, 'devices' => $devices, 'messages' => $messages]);
    }

    /**
     * Display a listing of the users.
     *
     */

    public function listUsers()
    {
        $users = User::all();
        return view('admin.userlist')->with(['users' => $users]);
    }


    public function bannedUsers()
    {
        $users = User::onlyTrashed()->get();
        return view('admin.bannedlist')->with(['users' => $users]);
    }


    public function banUser($id)
    {
        $userToBan = User::withTrashed()->find($id);
        if ($userToBan->deleted_at != NULL) {
            $userToBan->forceDelete();
            $bannedUsers = User::onlyTrashed()->get();
            return view('admin.bannedlist')->with(['users' => $bannedUsers]);
        }
        else{
            User::where('id', $id)->delete();
            $users = User::all();
            return view('admin.userlist')->with(['users' => $users]);
        }
    }


    public function restoreUser($id)
    {
        $user_recuperado = User::onlyTrashed()->find($id)->restore();
        $users = User::onlyTrashed()->get();
        return view('admin.bannedlist')->with(['users' => $users]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $user = User::find($id);
        return view('admin.profile')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.edit')->with(['user' => $user]);
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
            'avatar' => 'image',
            'name' => 'required|regex:/^[A-Za-záéíóú+ +]{1,20}$/m',
            'lastname' => 'regex:/^[A-Za-záéíóú+ +]{0,20}$/m',
            'biography' => 'regex:/^[A-Za-záéíóú0-9+ +\.]{0,150}$/m',
            'age' => 'regex:/^[0-9]{0,2}$/m',
            'country' => 'regex:/^[A-Za-z+ +]{0,20}$/m'
        ]);

        $messages = [
            'avatar.image' => 'Avatar must be a image file!',
            'name.required' => 'Name field is required!',
            'name.regex' => 'Name field must be a text between 1 and 20 words!',
            'lastname.regex' => 'Lastname must be a text between 0 and 20 words!',
            'biography.regex' => 'Biography must be a text between 0 and 150 words!',
            'age.regex' => 'Age must be a number!',
            'country.regex' => 'Country must be a text between 0 and 20 words!'
        ];


        // Update

        $user = User::find($id);

        $user->name = $request->name;
        $user->avatar = '/images/'.$request->avatar;
        $user->lastname = $request->lastname;
        $user->biography = $request->biography;
        $user->age = $request->age;
        $user->country = $request->country;

        $user->save();

        return view('admin.profile')->with(['user' => $user, 'messages' => $messages]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
