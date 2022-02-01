<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminTokenVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $usrer_type = 0; //admin
        // if ($usrer_type = Config('constants.admin')) {
        //     return $next($request);
        // }    
      
        if ($request->expectsJson()) {
            if (auth()->check() && auth()->user()->user_type == 0) {
               return $response = $next($request);                
            }
            return response()->json([
                'success' => Config('constants.invalidToken.success'),
                'message' => Config('constants.invalidToken.message'),
                'data'    => Config('constants.emptyData'),
            ], Config('constants.invalidToken.statusCode'));
        }
        return response()->json([
            'success' => Config('constants.invalidToken.success'),
            'message' => Config('constants.invalidToken.message'),
            'data'    => Config('constants.emptyData'),
        ], Config('constants.invalidToken.statusCode'));
    }
}
