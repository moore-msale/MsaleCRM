<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
class changeToMsalecrm
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
        if($request->user()->company != 'msalecrm'){
            config(['database.connections.mysql.database' => 'msalecrm']);
            DB::reconnect();
            return $next($request);
        }
        return $next($request);
    }
}
