<?php

namespace App\Http\Controllers;

use App\Models\BlockedUser;
use Exception;
use Illuminate\Http\Request;

class BlockedUserController extends Controller
{
    public function delete(Request $request){


        try{

            $blockedUser = BlockedUser::where('user_id', $request->user)->first();


            $blockedUser->delete();

            if($request->type == 'parent' ){

                return redirect()->route('admin.parents')->with('success', 'Parent successfully unblocked');

            }

            if($request->type == 'teacher'){
                return redirect()->route('admin.teachers')->with('success', 'Teacher successfully unblocked');

            }

            if($request->type == 'admin'){
                return redirect()->route('admin.admins')->with('success', 'Administrator successfully unblocked');

            }

        }catch(Exception $e){

            dd($e);
            if($request->type == 'parent' ){
                return redirect()->route('admin.parents')->with('error', ' Could not unblock parent');
            }

            if($request->type == 'teacher' ){
                return redirect()->route('admin.teachers')->with('error', ' Could not unblock teacher');
            }

            if($request->type == 'admin' ){
                return redirect()->route('admin.admins')->with('error', ' Could not unblock administrator');
            }

        }

    }
}
