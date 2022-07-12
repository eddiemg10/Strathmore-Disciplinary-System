<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\Classroom;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        return view('admin.homework.homework', $data);
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
                       ->select('users.first_name as firstname', 'users.last_name as lastname', 'assignments.*')
                       ->get();


        $data = [
            'classroom' => $classroom,
            'assignments' => $assignments,
            'date' => $current_date->format('d/m/Y'),

        ];

        return view('admin.homework.homework-entry-sheet', $data);
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
