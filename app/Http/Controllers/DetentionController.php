<?php

namespace App\Http\Controllers;

use App\Models\Detention;
use Illuminate\Http\Request;

class DetentionController extends Controller
{
    public function cofirmDetention(Request $request){

        $date = $request->detentionDate;
        $exists = Detention::where('detention_date', $date)->exists();

        return ['exists' => $exists, 'date' => $date];
    }
}
