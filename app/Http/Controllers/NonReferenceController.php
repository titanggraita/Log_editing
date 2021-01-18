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
        $non_reference_N = Transaction_logediting::all()->whereIn('logediting_isreferenced',0);
        $non_reference_R = Transaction_bookingediting::get();
        $data_N = Transaction_logediting::latest('id')->first();
        return view('non_reference', compact('non_reference_N', 'non_reference_R', 'data_N'));
    }
    public function fetch_NR(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('transaction_bookingediting')
                    ->join(('transaction_bookingeditingdetail'),
                     ('transaction_bookingediting.'.$select), '=', ('transaction_bookingeditingdetail.'.$select))
                    ->select('transaction_bookingeditingdetail.'.$dependent.'', 'transaction_bookingeditingdetail.bookingeditingdetail_date', 'transaction_bookingeditingdetail.bookingeditingdetail_shift')
                    ->where('transaction_bookingediting.'.$select, $value)
                    ->get();
        $output = '<option value="">--Select Booking Editing Line--</option>';
        foreach($data as $row){
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent." "."( "." Date: ".date('d M Y', strtotime($row->bookingeditingdetail_date))." , "." Shift: ".$row->bookingeditingdetail_shift." )".'</option>';
        }
        echo $output;

    }
    public function autofill_NR(Request $request)
    {
        $booking_id = $request->get('booking_id');
        $booking_line = $request->get('booking_line');
        $data = Transaction_bookingeditingdetail::select('eps_code', 'bookingeditingdetail_date', 'bookingeditingdetail_shift')
                    ->where('transaction_bookingeditingdetail.bookingediting_id', $booking_id)
                    ->where('transaction_bookingeditingdetail.bookingeditingdetail_line', $booking_line)
                    ->get();
        echo $data;
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
            'logediting_reference_id' => $request->bookingediting_id,
            'logediting_reference_line' => $request->bookingeditingdetail_line,
            'logediting_reference_code' => $request->kode_eps,
            'logediting_reason' => $request->editing_reason,
            'logediting_isreferenced' => 0,
            'logediting_generatedby' => $request->session()->get('nik'),
            'logediting_generateddate' => date('Y-m-d H:i:s.').$time,
            'logediting_generatedtime' => date('H:i:s.').$time
            //sisanya null
        ]);
        return redirect('/non_reference');
    }
}
