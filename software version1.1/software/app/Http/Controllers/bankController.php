<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class bankController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function bankPage(){

        return view('bank');
    }

    public function registerBank(Request $request){

        $bankName = $request->input('bank-name');
        $bankName = strtolower($bankName);
        $acNumber = $request->input('account-name');

        $chekData = DB::table('bank')->where('bankName',$bankName)->count();

        if($chekData>0){


            echo '0';

        }else{

            DB::table('bank')->insert([
                'bankName' => $bankName
            ]);
            echo "1";
        }

    }

    public function bankListPage(){
        $bankLists = DB::table('bankBalance')->get();
        return view('bankList')->withBankLists($bankLists);
    }

    public function addAcPage(){

        $bankName  = DB::table('bank')->get();

        return view('addBankAccount')->withBankName($bankName);

    }

    public function addAcName(Request $request){
        $bankName = $request->input('bank-name');
        $acNumber = $request->input('ac-name');

        $checkData = DB::table('bankAccount')->where('bankName',$bankName)->where('acName',$acNumber)->count();

        if($checkData>0){
           echo "0";
        }else{
            DB::table('bankAccount')->insert([
                'bankName' => $bankName,
                'acName' => $acNumber
            ]);
            echo "1";
        }


    }

}
