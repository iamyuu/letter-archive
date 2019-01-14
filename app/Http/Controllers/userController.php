<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role_id', '!=', 1)->orderBy('name', 'asc')->get();
        return view('admin.user', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $word = strtolower(strtok($request->name, " "));
        $role = '';
        return $request->all();
        if ($request->role == 1) {
            $role = $request->division;
        } else {
            $role = $request->role;
        }
        $user = new User();
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->username = $word;
        $user->password = bcrypt($word);
        $user->role_id = $role;
        if ($user->save()) return redirect()->back()->with('status', 'Berhasil');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $word = strtolower(strtok($request->name, " "));
        $user = new User();
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->username = $word;
        $user->password = bcrypt($word);

        if ($request->role == 1) {
            return '1';
            $user->role_id = $request->division;
        } else {
            return '2';
            $user->role_id = $request->role;
        }

        if ($user->save()) return redirect()->back()->with('status', 'Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user == Auth::id()) {
            return redirect()->back()->withErrors('User tidak bisa di hapus');
        }
        if ($user->delete()) return redirect()->back()->with('status', 'Berhasil');
    }
}
