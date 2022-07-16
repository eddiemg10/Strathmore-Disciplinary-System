<?php

namespace App\Http\Middleware;

use App\Models\UserTypeList;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isSeniorTeacher
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
        $exists = UserTypeList::where('user_type_id', 4)->where('user_id', Auth::id())->count();
        
        if($exists < 1){
            return abort(403, 'Unauthorized access to this resource');
        }

        return $next($request);
    }
}
