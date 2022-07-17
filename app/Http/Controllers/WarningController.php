<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Warning;
use App\Notifications\Detention;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarningController extends Controller
{
    public function index(){

        $verbals =  Warning::whereYear('created_at', date('Y'))->where('resolved', 0)->where('type', 'verbal')->get();
        $letters = Warning::whereYear('created_at', date('Y'))->where('resolved', 0)->where('type', 'letter')->get();
        $suspensions = Warning::whereYear('created_at', date('Y'))->where('resolved', 0)->where('type', 'suspension')->get();


        $data=[
            'verbals' => $verbals,
            'letters' => $letters,
            'suspensions' => $suspensions
        ];

        return view('teacher.discipline.updates', $data);
    }

    public function resolve(Request $request){
        try{
            $warning = Warning::find($request->warning);
            $warning->resolved = 1;
            $warning->save();


            $student = Student::find($warning->student_id); 

            $warningDate = $this->stringToHumanTime($warning->updated_at);

            foreach($student->parents as $parent){

                $notificationData=[
                    'message' => 'Kindly note that your son, '.$student->first_name.' '.$student->last_name.' has received a warning on '.$warningDate.' due to accumulation of bookings in his disciplinary record. You are advised to check his discipline record and discuss the same with him',
                    'action' => 'Check '.$student->first_name.'\'s disciplinary record',
                    'url' => route('parent.records', ['id'=>$student->id]),
                    'signoff' => 'Thank you'
                ];

                $parent->notify(new Detention((object)$notificationData));
            }

            return redirect()->route('discipline.updates')->with('success', 'Warning resolved and parents successfully notified');

        }catch(Exception $e){
            return redirect()->route('discipline.updates')->with('error', 'Could not resolve warning. An error occurred');

        }
        
    }

    public function showResolved(){

        $history = Warning::where('resolved', 1)->select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as warnings'))
                        ->groupBy((DB::raw('YEAR(created_at)')))->get();


        $data = [
            'history' => $history
        ];
        
        return view('teacher.discipline.updates_resolved', $data);
                    
    }

    public function getWarningHistory(Request $request){

        $year = $request->year;

        $verbals = Warning::where('resolved', 1)->whereYear('created_at', $year)->where('type', 'verbal')->get();
        $letters = Warning::where('resolved', 1)->whereYear('created_at', $year)->where('type', 'letter')->get();
        $suspensions = Warning::where('resolved', 1)->whereYear('created_at', $year)->where('type', 'suspension')->get();


        $data = [
            'verbals' => $verbals,
            'letters' => $letters,
            'suspensions' => $suspensions
        ];
        
        return view('teacher.discipline.resolved_warnings', $data);
        
    }

    public function stringToHumanTime($str){
        
        $oldDate =  strtotime($str);
        $newformat = date('jS F Y',$oldDate);
        return $newformat;
    }

}
