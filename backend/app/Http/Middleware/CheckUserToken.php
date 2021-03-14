<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CheckUserToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if ($request->header('user-token')) {
                $user = User::where('token', $request->header('user-token'))->first();
                if ($user) {
                    return $next($request);
                } else {
                    throw new \Exception('Token Missmatch', 401);
                }
            } else {
                throw new \Exception('Missing User Token', 404);
            }
        } catch (\Throwable $th) {
            $response = response()->json([
                'message' => $th->getMessage(),
                'status' => false,
                'code' => $th->getCode(),
                'data' => null,
            ]);
        }
        return $response;
    }
}
