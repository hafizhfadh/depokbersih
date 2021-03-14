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
        $post = Post::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $this->validation('update', $request, $id);
        Post::where('id', $id)->update($request->all());
        Post::find($id)->groups()->sync($request->groups);
    }

    public function status(Request $request, $id)
    {
        $post = Post::withTrashed()->find($id);
        if ($request->status) {
            $post->delete();
        } else {
            $post->restore();
        }
    }

    public function delete($id)
    {
        Post::where('id', $id)->delete();
    }
}
