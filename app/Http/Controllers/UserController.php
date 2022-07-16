<?php

namespace App\Http\Controllers;

use App\Models\BlockedUser;
use App\Models\ParentStudent;
use App\Models\StaffMember;
use App\Models\User;
use App\Models\UserType;
use App\Models\UserTypeList;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.parents',);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($userID)
    {
        $parent = User::find($userID);

        $data = [
            'parent' => $parent,
        ];


        return view("parent.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $parent = User::find($request->parent);

        try{

            $parent->first_name = $request->first_name;
            $parent->last_name = $request->last_name;
            $parent->email = $request->email;

            $parent->save();

            return redirect()->route('admin.parents')->with('success', $parent->first_name.' '.$parent->last_name.'\'s details successfully updated');

        }catch(Exception $e){
            return redirect()->route('admin.parents')->with('error', $parent->first_name.' '.$parent->last_name.'\'s details could not be updated');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        try{

            $user = User::find($request->user);

            $user->delete();

            if($request->type == 'parent' ){

                return redirect()->route('admin.parents')->with('success', 'Parent successfully deleted');

            }

            if($request->type == 'teacher'){
                return redirect()->route('admin.teachers')->with('success', 'Teacher successfully deleted');

            }

            if($request->type == 'admin'){
                return redirect()->route('admin.admins')->with('success', 'Administrator successfully deleted');

            }

        }catch(Exception $e){

            if($request->type == 'parent' ){
                return redirect()->route('admin.parents')->with('error', ' Could not delete parent');
            }

            if($request->type == 'teacher' ){
                return redirect()->route('admin.teachers')->with('error', ' Could not delete teacher');
            }

            if($request->type == 'admin' ){
                return redirect()->route('admin.admins')->with('error', ' Could not delete administrator');
            }

        }
        

        
    }

    public function block(Request $request){
        try{

            $blockedUser = new BlockedUser();
            $blockedUser->user_id = $request->user;

            $blockedUser->save();

            if($request->type == 'parent' ){

                return redirect()->route('admin.parents')->with('success', 'Parent successfully blocked');

            }

            if($request->type == 'teacher'){
                return redirect()->route('admin.teachers')->with('success', 'Teacher successfully blocked');

            }

            if($request->type == 'admin'){
                return redirect()->route('admin.admins')->with('success', 'Administrator successfully blocked');

            }

        }catch(Exception $e){

            if($request->type == 'parent' ){
                return redirect()->route('admin.parents')->with('error', ' Could not block parent');
            }

            if($request->type == 'teacher' ){
                return redirect()->route('admin.teachers')->with('error', ' Could not block teacher');
            }

            if($request->type == 'admin' ){
                return redirect()->route('admin.admins')->with('error', ' Could not block administrator');
            }

        }
    }

    public function parents(){


    }

    public function parentSearchAction(Request $request) 
    {
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');

            if($query != '')
            {
            //  $data = DB::table('students')
            //    ->Where('first_name', 'like', '%'.$query.'%')
            //    ->orWhere('last_name', 'like', '%'.$query.'%')
            //    ->orderBy('id', 'asc')
            //    ->get();

                $data = DB::table('user_type_lists')
                ->join('users', 'user_type_lists.user_id', '=', 'users.id')
                ->select('users.id',
                        'users.first_name', 
                        'users.last_name', 
                        'user_type_lists.user_type_id')
                 
                ->Where('user_type_id', '=', '1')      
                ->Where('first_name', 'like', ''.$query.'%')
                ->orWhere('last_name', 'like', ''.$query.'%')
                ->Where('user_type_id', '=', '1')
                ->orderBy('users.id')
                ->get();
                
            }
            // ->join(//Google Eloquent Query Builder joins)
            //   ->where('first_name', 'like', '%'.$query.'%')
            else
            {
                $data = DB::table('user_type_lists')
                ->join('users', 'user_type_lists.user_id', '=', 'users.id')
                ->select('users.id',
                        'users.first_name', 
                        'users.last_name', 
                        'user_type_lists.user_type_id')
                 
                ->Where('user_type_id', '=', '1')
                ->orderBy('users.id')
                ->get();
            }
            $total_row = $data->count();
            if($total_row > 0)
            {
            foreach($data as $row)
            {
                $output .= '
                <tr class="p-4 text-left text-xs w-1/2 hover:cursor-pointer odd:bg-white even:bg-gray-50" id="'.$row->id.'">
                <td class="pl-4 text-center py-2">'.$row->id.'</td>
                <td class="pl-4 py-2 text-center pr-8">'.$row->first_name. ' ' .$row->last_name.'</td>
                </tr>
                ';
            }
            }
            else
            {
            $output = '
            <tr class="text-xs">
                <td class="p-8" align="center" colspan="5">No Data Found</td>
            </tr>
            ';
            }
            $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row
            );

            echo json_encode($data);
            }
    }
}
