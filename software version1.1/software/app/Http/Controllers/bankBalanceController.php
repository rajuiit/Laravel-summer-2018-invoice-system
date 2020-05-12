<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;



class bankBalanceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
   public function myCashPage ()
   {
       //Total amount in bank account
       $total = DB::table('bankbalance')->sum('balance');
       $cash = DB::table('sellingvoucher')->where('cashCounter', 0)->sum('payment');
       $getOne = DB::table('customer')->where('due','>',0)->sum('due');

       //get one will be negative result so make it positive
       $getTwo = DB::table('seller')->where('get','<',0)->sum('get');
       $getTwo = -($getTwo);

       $totalGet = $getOne+$getTwo;


       // Due one will be in negetive result

       $dueOne = DB::table('customer')->where('due','<',0)->sum('due');
       $dueOne = -($dueOne);
       $dueTwo = DB::table('seller')->where('get','>',0)->sum('get');
       $totalDue = $dueOne+$dueTwo;


       if ($cash) {
           DB::table('sellingvoucher')->where('cashCounter', 0)->update([
               'cashCounter' => 1
           ]);

           $prevCash = DB::table('cash')->where('id', 1)->value('cash');

           $totalCash = $cash + $prevCash;

           DB::table('cash')->where('id', 1)->update([
               'cash' => $totalCash
           ]);

           $recent = DB::table('cash')->where('id', 1)->value('cash');


           //Bank and account name data fetch
           $bankInfo = DB::table('bank')->get();
           return view('myCash')->withTotal($total)->withRecent($recent)->withBankInfo($bankInfo)->withGet($totalGet)->withMyDue($totalDue);


       }else{
           $bankInfo = DB::table('bank')->get();

           $recent = DB::table('cash')->where('id', 1)->value('cash');
           return view('myCash')->withTotal($total)->withRecent($recent)->withBankInfo($bankInfo)->withGet($totalGet)->withMyDue($totalDue);


       }
   }

   public function getAcName($bankName){

       $acName = DB::table('bankAccount')->where('bankName',$bankName)->get();


       foreach($acName as $var){
           echo "

                 <option value=\"$var->acName\">$var->acName</option>

           ";
       }


   }


   /*
    public function test()
    {
        $cash = DB::table('sellingvoucher')->where('cashCounter', 0)->sum('payment');

        if($cash){
            DB::table('sellingvoucher')->where('cashCounter', 0)->update([
                'cashCounter'=> 1
            ]);

            $prevCash = DB::table('cash')->where('id',1)->value('cash');

            $totalCash = $cash+$prevCash ;

            DB::table('cash')->where('id',1)->update([
               'cash' => $totalCash
            ]);


        }

      } */

      public function sendToBank($bankName,$acName ,$amount){
      ;
      $checkData = DB::table('bankBalance')->where('bankName',$bankName)->where('acName',$acName)->count();

      if($checkData>0){

          $recent = DB::table('cash')->where('id', 1)->value('cash');
          $updatedCash = $recent-$amount;
          DB::table('cash')->where('id', 1)->update([
              'cash'=> $updatedCash
          ]);

          $currentBalance = DB::table('bankBalance')->where('bankName',$bankName)->where('acName',$acName)->value('balance');
          $updatedBalance = $currentBalance+$amount;

          DB::table('bankBalance')->where('bankName',$bankName)->where('acName',$acName)->update([
              'balance' => $updatedBalance
          ]);

      }else{

          $recent = DB::table('cash')->where('id', 1)->value('cash');
          $updatedCash = $recent-$amount;
          DB::table('cash')->where('id', 1)->update([
              'cash'=> $updatedCash
          ]);

          DB::table('bankBalance')->insert([
              'bankName' =>$bankName,
              'acName' => $acName,
              'balance' => $amount
          ]);

      }





      }

      public function wthdrawFromBank($bankName,$acName ,$amount){

          //Check if there is available
          $currentBalance = DB::table('bankBalance')->where('bankName',$bankName)->where('acName',$acName)->value('balance');

          if($currentBalance<$amount){
              echo "0";
          }else{
              $updatedBalance = $currentBalance-$amount;
              DB::table('bankBalance')->where('bankName',$bankName)->where('acName',$acName)->update([
                  'balance' => $updatedBalance
              ]);
              echo "1";


          }

      }


}
