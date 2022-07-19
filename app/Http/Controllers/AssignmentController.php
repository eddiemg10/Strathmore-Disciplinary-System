<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $classes = Classroom::all();

        $data = [
            "classrooms" => $classes,
        ];

        return view('teacher.homework.index', $data);
    }

    public function showStudentHomework($id, Request $request){
        
        $student = Student::find($id);
        $howework = 1;

        $data = [
            'student' => $student,
        ];

        return view('parent.student.homework', $data);

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

        $resource = null;

        if($request->file('file')){
            $file= $request->file('file');
            $extension= $request->file('file')->extension();
            $filename= date('YmdHi').Str::random(6);
            $resource= $filename.'.'.$extension;
            $file-> move(public_path('assets/homework'), $resource);
            
        }


        try{
            $assignment = Assignment::create([
                'subject' => $request->period,
                'classroom_id' => $request->classroom,
                'user_id' => Auth::id(),
                'description' => $request->comments,
                'resource' => $resource,
            ]);

            return redirect()->route('admin.homework.homework')->with('success', 'Homework was successfully added');
        }
        catch(Exception $e){
            dd($e);
            return redirect()->route('admin.homework.homework')->with('error', 'Erroe! Homework could not be added');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    
    public function show($classroom_id=1)
    {
        
        $classroom = Classroom::find($classroom_id);
        $current_date = Carbon::today();


        $assignments = DB::table('assignments')
                       ->join('users', 'assignments.user_id', '=', 'users.id' )
                       ->where('assignments.classroom_id', '=', $classroom_id)
                       ->whereDate('assignments.created_at', '=',$current_date)
                       ->select('users.first_name', 'users.last_name', 'assignments.*')
                       ->get();


        $data = [
            'classroom' => $classroom,
            'assignments' => $assignments,
            'date' => $current_date->format('d/m/Y'),

        ];

        return view('teacher.homework.show', $data);
    }

    public function showParent(Request $request){

        $classroom = Classroom::find($request->classroom);
        $current_date = date( 'Y-m-d', strtotime($request->date));


        $assignments = DB::table('assignments')
                       ->join('users', 'assignments.user_id', '=', 'users.id' )
                       ->where('assignments.classroom_id', '=', $classroom->id)
                       ->whereDate('assignments.created_at', '=', $current_date)
                       ->select('users.first_name', 'users.last_name', 'assignments.*')
                       ->get();


        $data = [
            'classroom' => $classroom,
            'assignments' => $assignments,
            'date' => $current_date,

        ];

        return view('parent.homework_view', $data);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}
