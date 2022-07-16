<?php

namespace App\Http\Controllers;

use App\Models\Warning;
use Exception;
use Illuminate\Http\Request;

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

            return redirect()->route('discipline.updates')->with('success', 'Warning resolved and parents successfully notified');

        }catch(Exception $e){
            return redirect()->route('discipline.updates')->with('error', 'Could not resolve warning. An error occurred');

        }
        
    }
}
