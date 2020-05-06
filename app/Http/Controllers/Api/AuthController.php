<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function checkAuth(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ]);
            $user = User::with('groups')->where('email', $request->get('email'))->first();
            if($user) {
                if ($user->email_verified_at) {
                    $auth = Hash::check($request->password, $user->password);
                    if ($user && $auth) {
                        $user->update(['token' => Str::random(64)]);
                        $response = $this->sendResponse($user->makeVisible(['token']),true,200,'Login Success');
                    } else {
                        throw new \Exception("Wrong password", 401);
                    }
                } else {
                    throw new \Exception("Email not verified", 401);
                }
            } else {
                throw new \Exception("Email not found", 401);
            }
        } catch (\Throwable $th) {
            if (method_exists($th, 'errors')) {
                $error = $th->errors();
            } else {
                $error = $th->getMessage();
            }
            $response = $this->sendResponse(null, false, $th->getCode(), $error);
        }
        return $response;
    }

    public function checkToken(Request $request)
    {
        // return $request;
        try {
            $this->validate($request, [
                'token' => 'required|string|min:8',
                'qrcode' => 'required|string|min:8',
            ]);
            $user = User::with('groups')->where([
                ['qrcode', '=', $request->get('qrcode')],
                ['token', '=', $request->get('token')],
            ])->first();
            if($user) {
                if ($user->email_verified_at) {
                    $response = $this->sendResponse($user->makeVisible(['token']),true,200,'Login Success');
                } else {
                    throw new \Exception("Email not verified", 401);
                }
            } else {
                throw new \Exception("Token has change", 401);
            }
        } catch (\Throwable $th) {
            if (method_exists($th, 'errors')) {
                $error = $th->errors();
            } else {
                $error = $th->getMessage();
            }
            $response = $this->sendResponse(null, false, $th->getCode(), $error);
        }
        return $response;
    }

    public function checkQrCode(Request $request)
    {
        try {
            $this->validate($request, [
                'qrcode' => 'required|string|min:8',
            ]);
            $user = User::with('groups')->where('qrcode', $request->get('qrcode'))->first();
            if($user) {
                if ($user->email_verified_at) {
                    $user->update(['token' => Str::random(64)]);
                    $response = $this->sendResponse($user->makeVisible(['token']),true,200,'Login Success');
                } else {
                    throw new \Exception("Email not verified", 401);
                }
            } else {
                throw new \Exception("QrCode not found", 401);
            }
        } catch (\Throwable $th) {
            if (method_exists($th, 'errors')) {
                $error = $th->errors();
            } else {
                $error = $th->getMessage();
            }
            $response = $this->sendResponse(null, false, $th->getCode(), $error);
        }
        return $response;
    }
}
