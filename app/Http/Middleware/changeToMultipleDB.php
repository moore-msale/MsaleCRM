<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
class changeToMultipleDB
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
        if($request->user()->company != 'multipledb'){
            config(['database.connections.mysql.database' => 'multipledb']);
            DB::reconnect();
            return $next($request);
        }
        return $next($request);
    }
}
