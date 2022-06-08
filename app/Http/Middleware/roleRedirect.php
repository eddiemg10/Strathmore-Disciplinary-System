<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AccountSelectController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserTypeList;

class roleRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $response = $next($request);

        // $roles =   Auth::user()->roles;

        // if(count($roles) > 1){
            return redirect()->action([AccountSelectController::class, 'selectAccount']);
        // }

        // return $roles->userType->type;

        // return redirect()->route($roles->userType->type);
    }
}
