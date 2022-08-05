<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JsonRequestHeader
{
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set("Accept", "application/json");
        $request->flat_errors = true;

        return $next($request);
    }
}
