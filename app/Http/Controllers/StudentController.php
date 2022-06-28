<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class StudentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classroom::all();
        $students = Student::all()->take(30);


        $data = [
            "classrooms" => $classes,
            "students" =>$students,
            'student' => Student::find(1),
        ];

        return view('admin.students', $data);
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
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($studentID)
    {
        $student = Student::find($studentID);
        $classes = Classroom::all();

        $data = [
            'student' => $student,
            "classrooms" => $classes,
        ];


        return view("student.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    public function studentSearchAction(Request $request) 
    {
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            $classroom = $request->get('classroom') ?? 'all'; 

            $paginate = $request->get('paginate') ?? 40;

            
            if($query != '')
            {
            //  $data = DB::table('students')
            //    ->Where('first_name', 'like', '%'.$query.'%')
            //    ->orWhere('last_name', 'like', '%'.$query.'%')
            //    ->orderBy('id', 'asc')
            //    ->get();

                $data = DB::table('students')
                ->join('classrooms', 'students.classroom_id', '=', 'classrooms.id')
                ->select('classrooms.id',
                        'students.id', 
                        'students.first_name', 
                        'students.last_name', 
                        'classrooms.name')
                 
                // ->where('classrooms.id','=', ''.$classroom)
                // ->where('students.first_name', 'like', ''.$query.'%')
                // ->orWhere('students.last_name', 'like', ''.$query.'%')
                // ->where('classrooms.id','=', ''.$classroom)
                ->orderBy('students.id');
                // ->get();
                
            }
            // ->join(//Google Eloquent Query Builder joins)
            //   ->where('first_name', 'like', '%'.$query.'%')
            else
            {
                $data = DB::table('students')
                ->join('classrooms', 'students.classroom_id', '=', 'classrooms.id')
                ->select('classrooms.id',
                        'students.id', 
                        'students.first_name', 
                        'students.last_name', 
                        'classrooms.name')
                ->orderBy('students.id');
                // ->Where('classrooms.id','=', ''.$classroom.'%')
                // ->get();
            }

            if($classroom !== 'all'){
                $data = $data->where('classrooms.id','=', ''.$classroom)
                             ->where('students.first_name', 'like', ''.$query.'%')
                             ->orWhere('students.last_name', 'like', ''.$query.'%')
                             ->where('classrooms.id','=', ''.$classroom)
                             ->get()
                             ->take($paginate);
            }
            else{
                $data = $data->where('students.first_name', 'like', ''.$query.'%')
                            ->orWhere('students.last_name', 'like', ''.$query.'%')
                            ->get()
                            ->take($paginate);

            }
            
            $total_row = $data->count();
            if($total_row > 0)
            {
            foreach($data as $row)
            {
                $output .= '
                <tr class="p-4 text-left text-xs w-1/2 student hover:cursor-pointer odd:bg-white even:bg-gray-50" id="'.$row->id.'">
                <td class="pl-4 text-center py-2">'.$row->id.'</td>
                <td class="pl-4 py-2 text-center">'.$row->first_name. ' ' .$row->last_name.'</td>
                <td class="pl-4 py-2 text-center">'.$row->name.'</td>
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

    public function getName(Request $request){

            $id = $request->get('student');
            $student = Student::find($id);

            $name = $student->first_name." ".$student->last_name;

            $badge = '<div class="bg-slate-50 rounded-full p-2 px-4 w-auto flex items-center gap-x-3 text-sm id=student-'.$id.'">'.$name.'<span class="mx-2">|</span> <i class="fa-solid hover:cursor-pointer fa-circle-xmark remove-student" data-id="'.$id.'"></i></div>';
            $data = [
                'name' => $badge,
            ];

            return $data;
    }

}
