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

            $role = $this->getRoleName($roles->first()->userType->id); 
            return redirect()->route($role);
        }

        else{
            return abort(404, "Not Found");

        }


        
    } 

    public function getRoleName($id){
        switch($id){
            case 1:
                return "parent";
            break;

            case 2:
                return "admin";
            break;

            case 3:
            case 4:
                return "teacher";

        }
    }
}
