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
    public function reference()
    {
        $reference_R = Transaction_logediting::all()->whereIn('logediting_isreferenced',1);
        $reference_B = Transaction_bookingeditingdetail::select('bookingediting_id')->groupBy('bookingediting_id')->get();
        return view('reference', compact('reference_R', 'reference_B'));
    }
    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = Transaction_bookingeditingdetail::where($select, $value)->groupBy($dependent)->get();
        $output = '<option value="">Select '.$dependent.'</option>';
        foreach($data as $row){
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }
        echo $output;

    }
    public function store_R(Request $request)
    {
        // insert data ke table 
        $time = str_pad(substr(microtime(true), 11,3), 3, STR_PAD_RIGHT);
        DB::table('transaction_logediting')->insert([
            'logediting_code' => date('H').substr(date('Y'), -2).date('i').date('m').date('s').date('d').$time,
            'logediting_reference_id' => $request->bookingediting_id,
            'logediting_reference_line' => $request->bookingeditingdetail_line,
            'logediting_reference_code' => $request->kode_eps,
            'logediting_useddate' => $request->editing_date,
            'logediting_usedshift' => $request->editing_shift,
            'logediting_isreferenced' => 1,
            'logediting_generatedby' => 'SYSTEM REFERENCE',
            'logediting_generateddate' => date('Y-m-d H:i:s.').$time,
            'logediting_generatedtime' => date('H:i:s.').$time
            //sisanya null
        ]);
        return redirect('/reference');
    }
}

