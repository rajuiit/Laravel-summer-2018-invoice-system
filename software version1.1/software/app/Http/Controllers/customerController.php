<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class customerController extends Controller
{
    //for viewing all

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function view(){

    }


    //for viewing inserting data
    public function insert(Request $request){

        $cusName = $request->input('cus-name');
        $cusName = strtolower($cusName);
        $cusAddress = $request->input('cus-address');
        $mobileNo = $request->input('mobile-no');

        $checkData = DB ::table('customer')->where('name',$cusName)->first();
        $checkMobile = DB ::table('customer')->where('mobile',$mobileNo)->first();

        if($checkData or $checkMobile){
            echo "0";
        }else{
            DB::table('customer')->insert([
                'name' => $cusName,
                'address' => $cusAddress,
                'due'    => 0,
                'mobile' => $mobileNo
            ]);

            echo '1';
        }




    }

    //for viewing inserting data
    public function insertCost(Request $request){

        $reason = $request->input('reason');
        $cost = $request->input('cost');

        //IF any data inside cart then delete it
        $timeDateVar = new Carbon();
        //  $timeDateVar = Carbon::now(new DateTimeZone('Asia/Bangladesh'));

        //  $timeZone =  $tz->toRegionTimeZone();
        $showingDate= $timeDateVar->toFormattedDateString();

        $mainDate = $timeDateVar->today();

            DB::table('dailycost')->insert([
                'reason' => $reason,
                'cost' => $cost,
                'date'    => $showingDate,


            ]);







    }


}
