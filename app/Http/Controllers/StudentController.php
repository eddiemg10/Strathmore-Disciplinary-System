<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Booking;
use App\Models\Classroom;
use App\Models\User;
use App\Models\Warning;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



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

    public function showStudentTeacher($studentID)
    {
        $student = Student::find($studentID);
        $history = Booking::where('student_id', $studentID)->select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as bookings'))
        ->groupBy((DB::raw('YEAR(created_at)')))->get();


        $data = [
            'student' => $student,
            'history' => $history
        ];


        return view("student.history", $data);
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
    public function update(Request $request)
    {


        $student = Student::find($request->student);

        

        try{

            if($request->file('profile_photo')){
                $file= $request->file('profile_photo');
                $extension= $request->file('profile_photo')->extension();
                $filename= date('YmdHi').Str::random(6);
                $profile_photo= $filename.'.'.$extension;
                $file-> move(public_path('assets/profile_pictures'), $profile_photo);

                $student->profile_photo = $profile_photo;
                
            }

            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->classroom_id = $request->classroom;

            $student->save();
            return redirect()->route('admin')->with('success', $student->first_name.' '.$student->last_name.'\'s details successfully updated');


        }catch(Exception $e){
            return redirect()->route('admin')->with('error', $student->first_name.' '.$student->last_name.'\'s details could not be updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $student = Student::find($request->student);
        try{
            $student->delete();
            return redirect()->route('admin')->with('success', 'Student successfully deleted');

        }catch(Exception $e){
            return redirect()->route('admin')->with('error', ' Could not delete student');

        }

    }

    // Parent view of child
    public function showStudentRecord($id){

        $student = Student::find($id);
        $history = Booking::where('student_id', $id)->select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as bookings'))
                        ->groupBy((DB::raw('YEAR(created_at)')))->get();
        $warnings = Warning::where('student_id', $id)->where('resolved', 1)->whereYear('updated_at', date('Y'))->get();

        $week = date('W');
        $dateRange = $this->getStartAndEndDate($week, 2022);


        $bookings = Booking::where('student_id', $id)->whereBetween('created_at', [$dateRange['week_start'], $dateRange['week_end']])->get();



        $data = [
            'student' => $student,
            'history' => $history,
            'warnings' => $warnings,
            'bookings' => $bookings,
        ];
        
        return view('parent.student.show', $data);

    }

    public function getStartAndEndDate($week, $year) {
        $dto = new DateTime();
        $dto->setISODate($year, $week);
        $ret['week_start'] = $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $ret['week_end'] = $dto->format('Y-m-d');
        return $ret;
      }


     // Teacher view of child
     public function showStudentHistory(Request $request){

        $classes = Classroom::all();
        $students = Student::all()->take(30);
        $selected = $request->student;


        $data = [
            "classrooms" => $classes,
            "students" =>$students,
            'selected' => $selected,
        ];

        
        return view('teacher.discipline.history', $data);

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
                ->select('classrooms.id as classroom',
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
                ->select('classrooms.id as classroom',
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
                <tr class="p-4 text-left text-xs w-1/2 student hover:cursor-pointer odd:bg-white even:bg-gray-50" id='.$row->id.' data-classroom='.$row->classroom.'>
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

            $badge = '<div class="bg-white shadow rounded-full p-2 px-4 w-auto flex items-center gap-x-3 text-sm id=student-'.$id.'">'.$name.'<span class="mx-2">|</span> <i class="fa-solid hover:cursor-pointer fa-circle-xmark remove-student" data-id="'.$id.'"></i></div>';
            $data = [
                'name' => $badge,
            ];

            return $data;
    }


    public function getStudentHistory(Request $request){

        $year = $request->year;
        $student = $request->student;

        $bookings = Booking::where('student_id', $student)->whereYear('created_at', $year)->get();

        $data = [
            'bookings' => $bookings,
        ];
        
        return view('student.bookings', $data);
        
    }

}
