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
        // date_default_timezone_set('Asia/Jakarta');
        $time = str_pad(substr(microtime(true), 12,3), 3, STR_PAD_RIGHT);
        DB::table('transaction_logediting')->insert([
            'logediting_code' =>date('H').substr(date('Y'), -2).date('i').date('m').date('s').date('d').$time,
            'logediting_useddate' => $request->editing_date." ".date('H:i:s.').$time,
            'logediting_usedshift' => $request->editing_shift,
            'logediting_reason' => $request->editing_reason,
            'logediting_isreferenced' => 0,
            'logediting_generatedby' => 'SYSTEM NON REFERENCE',
            'logediting_generateddate' => date('Y-m-d H:i:s.').$time,
            'logediting_generatedtime' => date('H:i:s.').$time
            //sisanya null
        ]);
        return redirect('/non_reference');
    }
    public function lihat_NR(){
        $non_reference = Transaction_logediting::all()->whereIn('logediting_isreferenced',0);
        return view('non_reference', ['non_reference' => $non_reference]);
    }
    // public function generate_CodeNR(){
    //     $generate = Transaction_logediting::all()->whereColumn('logediting_code');
    //     return view('non_reference', ['generate' => $generate]);
    // }
}
