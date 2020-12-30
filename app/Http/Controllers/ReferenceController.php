<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Transaction_logediting;
use App\Transaction_bookingediting;
use App\Transaction_bookingeditingdetail;
use App\Transaction_logeditingpriviledge;


class ReferenceController extends Controller
{
    public function reference(){
        return view('reference');
    }
    public function store_R(Request $request)
    {
        // insert data ke table 
        $time = str_pad(substr(microtime(true), 11,3), 3, STR_PAD_RIGHT);
        DB::table('transaction_logediting')->insert([
            'logediting_code' => date('H').substr(date('Y'), -2).date('i').date('m').date('s').date('d').$time,
            'logediting_reference_id' => $request->editing_id,
            'logediting_reference_line' => $request->editing_line,
            'logediting_reference_code' => $request->kode_eps,
            'logediting_useddate' => $request->editing_date." ".date('H:i:s.').$time,
            'logediting_usedshift' => $request->editing_shift,
            'logediting_isreferenced' => 1,
            'logediting_generatedby' => 'SYSTEM REFERENCE',
            'logediting_generateddate' => date('Y-m-d H:i:s.').$time,
            'logediting_generatedtime' => date('H:i:s.').$time
            //sisanya null
        ]);
        return redirect('/reference');
    }
    public function lihat_R(){ //tabel
        $reference = Transaction_logediting::all()->whereIn('logediting_isreferenced',1);
        return view('reference', ['reference' => $reference]);
    }
    public function autofill_ID(Request $request){ //autofill booking editing ID
        $data = Transaction_bookingediting::select("bookingediting_id")
                ->where("bookingediting_id","LIKE","%{$request->input('query')}%")
                ->get();
        return response()->json($data);
    }

    public function autofill_Line(Request $request){ //autofill booking editing Line
        $data = Transaction_bookingeditingdetail::select("bookingeditingdetail_line")
                ->where("bookingeditingdetail_line", "LIKE", "%{$request->input('query')}%")
                // ->orderBy("bookingediting_id")
                ->get();
        return response()->json($data);
    }
    
}

