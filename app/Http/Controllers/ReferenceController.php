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
        DB::table('transaction_logediting')->insert([
            'logediting_code' => $request->your_code,
            'logediting_reference_id' => $request->editing_id,
            'logediting_reference_line' => $request->editing_line,
            'logediting_reference_code' => $request->kode_eps,
            'logediting_useddate' => $request->editing_date,
            'logediting_usedshift' => $request->editing_shift,
            'logediting_isreferenced' => 1,
            'logediting_generatedby' => 'SYSTEM REFERENCE',
            'logediting_generateddate' => $request->editing_date,
            // 'logediting_generatedtime' => //time
            //sisanya null
        ]);
        return redirect('/reference');
    }
    public function lihat_R(){
        $reference = Transaction_logediting::all()->whereIn('logediting_isreferenced',1);
        return view('reference', ['reference' => $reference]);
    }
    public function autofill_ID(Request $request){
        if($request->get('query')){
            $query = $request->get('query');
            $data = DB::table('transaction_bookingediting')
                    ->where('bookingediting_id', 'LIKE', "%{$query}%")
                    ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:absolute;">';
            foreach($data as $row){
                $output .= '
                <li><a class="dropdown-item" href="#">'.$row->bookingediting_id.'</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function autofill_Line(Request $request){
        if($request->get('query')){
            $query = $request->get('query');
            $data = DB::table('transaction_bookingeditingdetail')
                    ->where('bookingeditingdetail_line', 'LIKE', "%{$query}%")
                    ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:absolute">';
            foreach($data as $row){
                $output .= '
                <li><a class="dropdown-item" href="#">'.$row->bookingeditingdetail_line.'</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function generate_CodeR(){

    }
}

