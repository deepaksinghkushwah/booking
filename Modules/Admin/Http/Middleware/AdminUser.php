<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUser
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
        //echo "<pre>";print_r($request->session()->);echo "</pre>";
        /*if(isset(Auth::user()->id) && $request->session()->get("isAdmin") == true){
            echo "User is logged in and admin";
        } else {
            echo "User is logged in not admin";
        }*/
        $user = Auth::user();
        if(!$user->hasAnyRole("Admin","Sub-Admin")){
            return redirect()->route("dashboard")->with("danger","You are not authorized to perform this action");
        }
        return $next($request);
    }
}
