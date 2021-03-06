<?php

namespace App\Http\Controllers;

use App\Models\Detention as ModelsDetention;
use App\Models\Student;
use App\Models\User;
use App\Notifications\Detention;
use Exception;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifyOnDetention(Request $request){

        $user = User::find(44);

        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $detentionDate = $request->detentionDate;

        $humanStartDate = date('jS F Y',strtotime($startDate));
        $humanEndDate = date('jS F Y',strtotime($endDate));
        $humanDetentionDate = date('jS F Y',strtotime($detentionDate));


        $DTList = app('App\Http\Controllers\BookingController')->getDetentionData($startDate, $endDate);

        $students = [];

        foreach($DTList as $list){
            foreach($list['bookings'] as $booking){
                !in_array($booking->student_id, $students) && array_push($students, $booking->student_id);
            }
        }
        // return $students;

        try{

            $detention = new ModelsDetention();
            $detention->detention_date = $detentionDate;
            $detention->save();
       
            foreach($students as $student_id){
                $student = Student::find($student_id);
                foreach($student->parents as $parent){

                    $notificationData=[
                        'message' => 'Kindly note that your son, '.$student->first_name.' '.$student->last_name.' has detention due to disciplinary booking he received from '.$humanStartDate.' to '.$humanEndDate,
                        'action' => 'Check '.$student->first_name.'\'s disciplinary record',
                        'url' => route('parent.records', ['id'=>$student->id]),
                        'signoff' => 'Kindly ensure your son is in school on '.$humanDetentionDate.' for the detention'
                    ];

                    $parent->notify(new Detention((object)$notificationData));
                }

            }

            $data = [
                'success' => true,
                'message' => "Parents Successfully notified",
            ];

            return json_encode($data);

        }catch(Exception $e){

            $data = [
                'success' => false,
                'message' => "An error occurred in notifying parents",
            ];

            return json_encode($data);
        }

        

        // 
    }
}
