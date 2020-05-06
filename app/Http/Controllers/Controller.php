<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected function sendResponse($data = null,$status = false, $code = 520, $message = "Unknown Error")
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
            'code' => $code,
            'data' => $data,
        ]);
    }
}
