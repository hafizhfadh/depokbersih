<?php

namespace App\Http\Middleware;

use Closure;

class CheckApplicationToken
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
        $token = $request->header('application-token');
        try {
            if ($token) {
                if (env('APPLICATION_TOKEN') ?? $token) {
                    return $next($request);
                }
                throw new \Exception("Unauthorized Token", 401);
            } else {
                throw new \Exception("Token not found", 404);
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
