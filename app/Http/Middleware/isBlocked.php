<?php

namespace App\Http\Middleware;

use App\Models\BlockedUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isBlocked
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

        if(Auth::check()){
            $isBlocked = Auth::User()->blocked;

            if($isBlocked){

                return abort(403, 'Your account has been suspended. Get in contact with us at starthmore@gmail.com if you have further queries');
                // return response(view('blocked'));
            }
        }
        

        return $response;
    }
}
