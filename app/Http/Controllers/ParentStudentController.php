<?php

namespace App\Http\Controllers;

use App\Models\ParentStudent;
use Exception;
use Illuminate\Http\Request;

class ParentStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $parent = $request->parent;
        $students = json_decode($request->students);

        try{
            foreach($students as $student){
                $newEntry = new ParentStudent();
                $newEntry->user_id = $parent;
                $newEntry->student_id = $student;
                $newEntry->save();
            }

            return ['success' => 'Successfully added students'];
        } catch(Exception $e){
            dd($e);
            return ['error' => 'Error. could not add students'];

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParentStudent  $parentStudent
     * @return \Illuminate\Http\Response
     */
    public function show(ParentStudent $parentStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParentStudent  $parentStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(ParentStudent $parentStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParentStudent  $parentStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParentStudent $parentStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParentStudent  $parentStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParentStudent $parentStudent)
    {
        //
    }
}
