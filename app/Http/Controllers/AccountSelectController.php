<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountSelectController extends Controller
{
    public function selectAccount(){

        $roles =  Auth::user()->roles;
        // return $roles;

        if(count($roles) > 1){
            $data = [
                'roles' => $roles,
            ];
            return view('account_select', $data);
        }

        if(count($roles) === 1){

            $role = $roles->first()->userType->type; 
            return redirect()->route($role);
        }

        else{
            return abort(404, "Not Found");

        }


        
    } 
}
