<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        try {
            $post = Post::all();
            return $this->sendResponse($post,true,200,'Get Post Success');
        } catch (\Throwable $th) {
            if (method_exists($th, 'getMessage')) {
                return $this->sendResponse($th->getMessage(), $th->getCode());
            }
        }
    }
}
