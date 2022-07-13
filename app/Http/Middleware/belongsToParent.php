<?php

namespace App\Http\Middleware;

use App\Models\ParentStudent;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class belongsToParent
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

        // Check if student is registered under this parent 
        $student_id = $request->id;
        $exists = ParentStudent::where('user_id', Auth::User()->id)->where('student_id', $student_id)->exists();


        if(!$exists){
            abort(403, 'Unauthorized access. This student is not registered under you');
        }

        return $next($request);
    }
}
