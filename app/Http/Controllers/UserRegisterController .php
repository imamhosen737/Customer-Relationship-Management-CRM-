<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Departments;
use App\Http\Requests\UserRegisterRequest;

class UserRegisterController extends Controller
{
    public function index()
    {
        // $departments = Departments::where('id', '!=', 1)->get();
        // $users = User::whereIn('role', ['admin'])
        //     ->get();
        // return  view('admin.users.index', compact('users', 'departments'));
        echo "ok";
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegisterRequest $request)
    {
        try {
            $user = User::create($request->persist());
            return redirect()->back()->with('success', 'User added successfully.');
        } catch (\Exception $e) {
            // return $e->getMessage();
            return redirect()->back()->with('error', $e->errorInfo ? $e->errorInfo[2] : 'Data insert failed !');
        }
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
        $departments = Departments::where('id', '!=', 1)->get();
        return view('admin.users.edit', compact('user', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRegisterRequest $request, $id)
    {
        try {
            $user = User::find($id);
            $user->update($request->persist());
            return redirect('admin/users')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {

            // return $e->getMessage();
            return redirect()->back()->with('error', $e->errorInfo ? $e->errorInfo[2] : 'Data update failed !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                $user->delete();
                return response()->json(['status' => 'success', 'message' => 'User Deleted Successfully !']);
            }
            return response()->json(['status' => 'error', 'message' =>  'Deleted Failed !']);
        } catch (\Exception $e) {
            return $e;
            return response()->json(['status' => 'error', 'message' =>  'Deleted Failed !']);
        }
    }
}
