<?php

namespace App\Http\Controllers;

use App\Models\StaffMember;
use Illuminate\Http\Request;
use App\Models\UserType;
use App\Models\User;
use App\Models\Classroom;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class StaffMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classroom::all();

        $data = [
            "classrooms" => $classes,
        ];

        return view('admin.teachers', $data);
    }

    public function indexAdmins(){
        $classes = Classroom::all();

        $data = [
            "classrooms" => $classes,
        ];

        return view('admin.administrators', $data);
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
     * @param  \App\Models\StaffMember  $staffMember
     * @return \Illuminate\Http\Response
     */
    public function show($staffMemberID)
    {
        $teacher = User::find($staffMemberID);
        $classes = Classroom::all();


        $data = [
            'teacher' => $teacher,
            "classrooms" => $classes,

        ];


        return view("teacher.show", $data);
    }

    public function showAdmin($staffMemberID){
        $admin = User::find($staffMemberID);


        $data = [
            'admin' => $admin,

        ];


        return view("admin.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StaffMember  $staffMember
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffMember $staffMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StaffMember  $staffMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $teacher = User::find($request->user);
        $staff = StaffMember::where('user_id', $request->user)->first();

        try{

            if($request->file('profile_photo')){
                $file= $request->file('profile_photo');
                $extension= $request->file('profile_photo')->extension();
                $filename= date('YmdHi').Str::random(6);
                $profile_photo= $filename.'.'.$extension;
                $file-> move(public_path('assets/profile_pictures'), $profile_photo);

                $teacher->profile_photo = $profile_photo;
                
            }

            $teacher->first_name = $request->first_name;
            $teacher->last_name = $request->last_name;
            $teacher->email = $request->email;

            $staff->staff_number = $request->staff_number;
            $staff->save();

            $teacher->save();

            if($request->type == 'teacher'){
                return redirect()->route('admin.teachers')->with('success', $teacher->first_name.' '.$teacher->last_name.'\'s details successfully updated');
            }
            if($request->type == 'admin'){
                return redirect()->route('admin.admins')->with('success', $teacher->first_name.' '.$teacher->last_name.'\'s details successfully updated');
            }

        }catch(Exception $e){

            if($request->type == 'teacher'){
                return redirect()->route('admin.teachers')->with('error', $teacher->first_name.' '.$teacher->last_name.'\'s details could not be updated');
            }
            if($request->type == 'admin'){
                return redirect()->route('admin.admins')->with('error', $teacher->first_name.' '.$teacher->last_name.'\'s details could not be updated');
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StaffMember  $staffMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffMember $staffMember)
    {
        //
    }

    public function teacherSearchAction(Request $request) 
    {
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            $type = $request->get('type');

            if($type == 'admin'){
                if($query != '')
                {

                $data = DB::table('user_type_lists')
                ->join('users', 'user_type_lists.user_id', '=', 'users.id')
                ->select('users.id',
                        'users.first_name', 
                        'users.last_name', 
                        'user_type_lists.user_type_id')
                
                ->where('first_name', 'like', ''.$query.'%')
                ->where('user_type_id', '=', '2')
                ->orWhere('last_name', 'like', ''.$query.'%')
                ->where('user_type_id', '=', '2')      
                ->orderBy('id')
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
                    
                    ->Where('user_type_id', '=', '2')
                    ->orderBy('users.id')
                    ->get();
                }
            }
            else{

            
                if($query != '')
                {

                $data = DB::table('user_type_lists')
                ->join('users', 'user_type_lists.user_id', '=', 'users.id')
                ->select('users.id',
                        'users.first_name', 
                        'users.last_name', 
                        'user_type_lists.user_type_id')
                
                ->where('first_name', 'like', ''.$query.'%')
                ->where('user_type_id', '=', '3')
                ->orWhere('last_name', 'like', ''.$query.'%')
                ->where('user_type_id', '=', '3')      
                ->orderBy('id')
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
                    
                    ->Where('user_type_id', '=', '3')
                    ->orderBy('users.id')
                    ->get();
                }
            }
        

            $total_row = $data->count();
            if($total_row > 0)
            {
            foreach($data as $row)
            {
                $teacher = User::find($row->id);

                $output .= '
                <tr class="p-4 text-left text-xs w-1/2 hover:cursor-pointer odd:bg-white even:bg-gray-50" id="'.$row->id.'">
                <td class="pl-4 text-center py-2">'.$teacher->staff->staff_number.'</td>
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

