<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Classroom;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Class_;

class BookingController extends Controller
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

        return view('admin.discipline.behaviour_sheet', $data);
    }

    public function detention()
    {
        //
        $classes = Classroom::all();

        $data = [
            "classrooms" => $classes,
        ];

        return view('admin.discipline.detention', $data);
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
        $students = json_decode($request->students);
        $comments = $request->comments;
        $period = $request->period;


        try{
            foreach($students as $student){
                $booking = new Booking();
    
                $booking->student_id = $student->student;
                $booking->staff_member_id = Auth::User()->id;
                $booking->offence = $comments;
                $booking->period = $period;
                $booking->classroom_id = $student->classroom;
    
                $booking->save();
                            
            }


            return ['success'=>'Booking successfully added'];

        }catch(Exception $e){
           

            return ['error'=>'Booking successfully added'];

        }
        

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show($classroom_id=1)
    {
        
        $classroom = Classroom::find($classroom_id);
        $current_date = Carbon::today();


        $bookings = DB::table('bookings')
                       ->join('students', 'bookings.student_id', '=', 'students.id' )
                       ->join('staff_members', 'bookings.staff_member_id', '=', 'staff_members.id' )
                       ->join('users', 'staff_members.user_id', '=', 'users.id' )
                       ->where('bookings.classroom_id', '=', $classroom_id)
                       ->whereDate('bookings.created_at', '=',$current_date)
                       ->select('students.first_name', 'students.last_name', 'users.first_name as trfname', 'users.last_name as trlname', 'bookings.*')
                       ->get();


        $data = [
            'classroom' => $classroom,
            'bookings' => $bookings,
            'date' => $current_date->format('d/m/Y'),

        ];

        return view('admin.discipline.behaviour_sheet_entry', $data);
    }

    public function showUnassessed(Request $request){

        $startDate = $request->startDate ?? '2022/06/29';
        $endDate = $request->endDate ?? '2022/07/09';

        $bookings = Booking::whereBetween('created_at', [
            $startDate, 
            Carbon::parse($endDate)->endOfDay(),
            ])->orderBy('created_at', 'desc')->where('assessment', null)->get();
        
       

        $data = [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'bookings' => $bookings,
        ];
        return view('admin.discipline.bookings.unassessed_bookings', $data);

    }

    public function showAssessed(Request $request){

        $startDate = $request->startDate ?? '2022/06/29';
        $endDate = $request->endDate ?? '2022/07/09';

        $bookings = Booking::whereBetween('created_at', [
            $startDate, 
            Carbon::parse($endDate)->endOfDay(),
            ])->orderBy('student_id', 'asc')->where('assessment', '>', '0');
        

        // $classrooms = $bookings->distinct('classroom_id')->count();

        $DTList = [];

        $asssesedBookings = $bookings->get();

        $classrooms = $bookings->select('classroom_id')->distinct()->get();

        foreach($classrooms as $classroom){

            foreach($asssesedBookings as $ab){
                
            
                array_push($DTList,[
                    "classroom" => $classroom,
                    "bookings" => [

                    ],
                ]);
            }
        }



        return $classrooms;
        

        return $bookings;

        $data = [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'bookings' => $bookings->get(),
        ];
        return view('admin.discipline.bookings.assessed_bookings', $data);
    }

    public function assessBookings(Request $request){

        $assessments = json_decode($request->assessments);

        try{
            foreach($assessments as $assmt){
                $booking = Booking::find($assmt->booking);
                $booking->assessment = $assmt->assessment;
                $booking->updated_by = Auth::User()->id;
                $booking->save();

            }

            return ['success'=>'Bookings Successfully assessed'];

        }catch(Exception $e){

            return ['error'=>' An error occured in assessing bookings. Please try again later'];
            
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
