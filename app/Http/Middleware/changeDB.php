<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
class changeDB
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
        if($request->user()->company != config('database.connections.mysql.database')){
            config(['database.connections.mysql.database' => $request->user()->company]);
            DB::reconnect();
            return $next($request);
        }
        return $next($request);
    }
}
