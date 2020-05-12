<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class invoiceViewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sellingInvoiceViewPage($voucherNo){

        $voucherInfo = DB::table('sellingvoucher')->where('voucherNo',$voucherNo)->first();
        $voucherHolder = $voucherInfo->customerName;

        $getStillDue = DB::table('customer')->where('name',$voucherHolder)->value('due');

        if(!$getStillDue){

            $voucherDetailsInfo =  DB::table('deleveredproduct')->where('voucherNo',$voucherNo)->get();
            $vouchersTotal =  DB::table('deleveredproduct')->where('voucherNo',$voucherNo)->sum('sellingPrice');
            $getStillDue= "Customer is deleted !";
            return view('sellingVoucherView')->withVoucherInfo($voucherInfo)->withVoucherDetailsInfo($voucherDetailsInfo)->withVouchersTotal($vouchersTotal)->withGetStillDue($getStillDue);

        } else{
            $getStillDue = $getStillDue. "TK";
            $voucherDetailsInfo =  DB::table('deleveredproduct')->where('voucherNo',$voucherNo)->get();
            $vouchersTotal =  DB::table('deleveredproduct')->where('voucherNo',$voucherNo)->sum('sellingPrice');

            //passing data on invoice view page

            return view('sellingVoucherView')->withVoucherInfo($voucherInfo)->withVoucherDetailsInfo($voucherDetailsInfo)->withVouchersTotal($vouchersTotal)->withGetStillDue($getStillDue);


        }




    }



    public function buyingInvoiceViewPage($voucherNo){

        $voucherInfo = DB::table('buyingvoucher')->where('voucherNo',$voucherNo)->first();
        $voucher= $voucherNo;
        $voucherHolder = $voucherInfo->sellerName;

        $getStillDue = DB::table('seller')->where('name',$voucherHolder)->value('get');

        if(!$getStillDue){

            $voucherDetailsInfo =  DB::table('broughtproduct')->where('voucherNo',$voucherNo)->get();
            $getStillDue= "Seller is deleted !";
            return view('buyingVoucherView')->withVoucherInfo($voucherInfo)->withVoucherDetailsInfo($voucherDetailsInfo)->withGetStillDue($getStillDue)->withVoucher($voucher);

        } else{
            $getStillDue = $getStillDue. "TK";
            $voucherDetailsInfo =  DB::table('broughtproduct')->where('voucherNo',$voucherNo)->get();



            //passing data on invoice view page

            return view('buyingVoucherView')->withVoucherInfo($voucherInfo)->withVoucherDetailsInfo($voucherDetailsInfo)->withGetStillDue($getStillDue)->withVoucher($voucher);


        }




    }


}
