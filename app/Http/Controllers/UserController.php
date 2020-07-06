<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Group;
use App\User;

class UserController extends Controller
{
    private function validation($type, $request, $id = null) {
        $this->validate($request, [
            'groups.*' => 'required|exists:groups,id',
            'name' => 'required',
            'phone_number' => 'required|numeric',
            'address' => 'required',
            'email' => 'required|unique:users,email,'.$id.''
        ]);
    }

    public function index()
    {
        return view('user.index');
    }

    public function form($type, $id = null)
    {
        if ($type == 'create') {
            $data = null;
            return view('user.form', compact('type', 'data'));
        } elseif ($type == 'edit') {
            $data = User::with('province', 'regency', 'district', 'village', 'groups')->where('id', $id)->first();
            return view('user.form', compact('type', 'data', 'id'));
        } else {
            abort(404);
        }
    }

    public function store(Request $request)
    {
        $this->validation('store', $request);
        $request->request->add(['password' => bcrypt('password')]);
        $user = User::create($request->except('groups'));
        $user->groups()->sync($request->groups);
    }

    public function update(Request $request, $id)
    {
        $this->validation('update', $request, $id);
        User::where('id', $id)->update($request->except('groups'));
        User::find($id)->groups()->sync($request->groups);
    }

    public function status(Request $request, $id)
    {
        User::where('id', $id)->update(['status' => $request->status]);
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
    }

    public function changePassword(Request $request, $id)
    {
        $this->validate($request, [
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8|confirmed',
        ]);
        try {
            $user = User::where('id', $id)->first()->makeVisible(['password']);
            if (Hash::check($request->old_password, $user->password)) {
                $user->update(['password' => Hash::make($request->new_password)]);
            } else {
                throw new \Exception('Password lama salah', 422);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], $th->getCode() == 0? 500 : $th->getCode());
        }
    }

    public function groupList(Request $request)
    {
        if ($request->q) {
            $group = Group::where('name', 'like', '%'.$request->q.'%')->get();
        } elseif ($request->id) {
            $group = Group::where('id', $request->id)->first();
        } else {
            $group = Group::get();
        }
        return response()->json(['data' => $group]);
    }

    public function userList(Request $request)
    {
        if ($request->q) {
            $users = User::where('name', 'like', '%'.$request->q.'%')->get();
        } elseif ($request->id) {
            $users = User::where('id', $request->id)->first();
        } else {
            $users = User::get();
        }
        return response()->json(['data' => $users]);
    }
}
