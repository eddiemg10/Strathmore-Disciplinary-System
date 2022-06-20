<?php

namespace App\Http\Controllers;

use App\Models\StaffMember;
use Illuminate\Http\Request;
use App\Models\UserType;
use App\Models\UserTypeList;
use App\Models\Classroom;
use Illuminate\Support\Facades\DB;

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
    public function show(StaffMember $staffMember)
    {
        //
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
    public function update(Request $request, StaffMember $staffMember)
    {
        //
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
             
            ->Where('first_name', 'like', ''.$query.'%')
            ->Where('last_name', 'like', ''.$query.'%')
            ->Where('user_type_id', '=', '3')      

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
            $total_row = $data->count();
            if($total_row > 0)
            {
            foreach($data as $row)
            {
                $output .= '
                <tr class="p-4 text-left text-xs w-1/2 text-xl" id="'.$row->id.'">
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

