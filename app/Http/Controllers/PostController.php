<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private function validation($type, $request, $id = null) {
        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required|numeric',
            'address' => 'required',
            'email' => 'required|unique:posts,email,'.$id.''
        ]);
    }

    public function index()
    {
        return view('post.index');
    }

    public function form($type, $id = null)
    {
        if ($type == 'create') {
            $data = null;
            return view('post.form', compact('type', 'data'));
        } elseif ($type == 'edit') {
            $data = Post::where('id', $id)->first();
            return view('post.form', compact('type', 'data', 'id'));
        } else {
            abort(404);
        }
    }

    public function store(Request $request)
    {
        $this->validation('store', $request);
        $request->request->add(['password' => bcrypt('password')]);
        $post = Post::create($request->except('groups'));
        $post->groups()->sync($request->groups);
    }

    public function update(Request $request, $id)
    {
        $this->validation('update', $request, $id);
        Post::where('id', $id)->update($request->except('groups'));
        Post::find($id)->groups()->sync($request->groups);
    }

    public function status(Request $request, $id)
    {
        Post::where('id', $id)->update(['status' => $request->status]);
    }

    public function delete($id)
    {
        Post::where('id', $id)->delete();
    }
}
