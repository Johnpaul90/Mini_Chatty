<?php

namespace Chatty\Http\Middleware;


use Closure;
use Auth;
use Session;


class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard=null)
    {
        if(Auth::guard($guard)->guest()){

            if($request->ajax()|| $request ->wantsJson()){
                return response('Unauthorized',401);
            }else{
                return redirect()->route('auth.signin');
            }
        }
        return $next($request);

    }
}
