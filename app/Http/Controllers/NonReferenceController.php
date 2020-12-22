<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Transaction_logediting;
use App\Transaction_bookingediting;
use App\Transaction_bookingeditingdetail;
use App\Transaction_logeditingpriviledge;

class NonReferenceController extends Controller
{
    public function non_reference(){
    	return view('non_reference');
    }

    public function store_NR(Request $request)
    {
        // insert data ke table 
        DB::table('transaction_logediting')->insert([
            'logediting_code' => $request->your_code,
            'logediting_useddate' => $request->editing_date,
            'logediting_usedshift' => $request->editing_shift,
            'logediting_reason' => $request->editing_reason,
            'logediting_isreferenced' => 0,
            'logediting_generatedby' => 'SYSTEM NON REFERENCE',
            'logediting_generateddate' => $request->editing_date
            // 'logediting_generatedtime' => //time
            //sisanya null
        ]);
        return redirect('/non_reference');
    }
    public function lihat_NR(){
        $non_reference = Transaction_logediting::all()->whereIn('logediting_isreferenced',0);
        return view('non_reference', ['non_reference' => $non_reference]);
    }
    public function generate_CodeNR(){

    }
}
