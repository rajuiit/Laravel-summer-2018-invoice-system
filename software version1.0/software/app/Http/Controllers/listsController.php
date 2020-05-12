<?php

namespace App\Http\Controllers;

use function foo\func;
use Illuminate\Http\Request;
use DB;

class listsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sellingVoucherList(){
      $sellingVouchers= DB::table('sellingVoucher')->where('id', '>',131)->get();
       return view('sellingVoucherLists')->withSellingVouchers($sellingVouchers);

    }


    //Fetch data after clicking on view button for  selling voucher----------------------
    public function sellingProductsView($voucherNo){

        $getId = DB::table('deleveredproduct')->where('voucherNo',$voucherNo)->get();
        $rowNo =0;


      foreach ($getId as $var){
            $rowNo++;
            echo"                       <tr>
                                            <th scope=\'row\'>$rowNo</th>
                                            <td>$var->brand</td>
                                            <td>$var->modelName</td>
                                            <td>$var->type</td>
                                            <td>$var->quantity</td>
                                            <td>$var->sellingPrice</td>
                                        </tr> ";
        };


    }

    //Fetch data after deleting selling voucher----------------------

    public function deleteVoucher($voucherNo){
        //First deleting voucher
        DB::table('sellingvoucher')->where('voucherNo',$voucherNo)->delete();
        DB::table('deleveredproduct')->where('voucherNo',$voucherNo)->delete();

        echo "1";



    }

    public function  fetchDataAfterDelete()
    {
       $sellingVouchers= DB::table('sellingVoucher')->where('id', '>', 129)->get();;

        foreach ($sellingVouchers as $var) {

            echo "
            
             <tr>
                                    <td>$var->customerName</td>
                                    <td>$var->voucherNo</td>
                                    <td>$var->date</td>
                                    <td ><a href=\"/sellingVoucherView/$var->voucherNo\"  class=\"btn btn-success\" >View</a> <a href=\"/returnPage/$var->voucherNo\" class=\"btn btn-primary return\" >Edi</a> <a onclick=\"deletingIdPass('$var->voucherNo')\" class=\"btn btn-danger\">Delete</a>
</td>

                                </tr>
            
            ";


        }
    }



    public function productList(){

      $list = DB::table('model')->get();

      return view('productList')->withList($list);


    }


    public function deleteProduct($modelName){
        //First deleting voucher
        DB::table('model')->where('modelName',$modelName)->delete();
        echo "1";


    }
    public function  fetchAfterDeleteProductList()
    {
        $productList = DB::table('model')->get();

        foreach ($productList as $var) {

            echo "
            
               <tr>
                                    <td>$var->brand</td>
                                    <td>$var->modelName</td>
                                    <td>$var->type</td>
                                    <td>$var->buyingPrice</td>
                                    <td>$var->sellingPrice</td>
                                    <td onclick=\"deleteModel('$var->modelName')\" class=\"btn btn-danger btn-xs\">Delete</td>

                                </tr>
            ";


        }
    }





    public function buyerList(){

        $list = DB::table('customer')->get();

        return view('buyerList')->withList($list);


    }


    public function deleteCustomer($customerName){
        //First deleting voucher
        DB::table('customer')->where('name',$customerName)->delete();
        echo "1";


    }
    public function  fetchAfterDeleteCustomer()
    {
        $customerList = DB::table('customer')->get();

        foreach ($customerList as $var) {

            echo "
               
                <tr>
                                    <td>$var->name</td>
                                    <td>$var->address</td>
                                    <td>$var->due</td>
                                    <td onclick=\"deleteCustomer('$var->name')\" class=\"btn btn-danger btn-xs\">Delete</td>

                                </tr>
                
            ";


        }
    }

    public function storageList(){

        $list = DB::table('storage')->get();

        return view('storage')->withList($list);


    }



    public function sellerList(){

        $list = DB::table('seller')->get();

        return view('sellerLists')->withList($list);


    }

    public function deleteSeller($sellerName){
        //First deleting voucher
        DB::table('seller')->where('name',$sellerName)->delete();
        echo "1";


    }






    public function  fetchAfterDeleteSeller()
    {
        $sellerList = DB::table('seller')->get();

        foreach ($sellerList as $var) {

            echo "
            
                <tr>
                                    <td>$var->name</td>
                                    <td>$var->address</td>
                                    <td>$var->get</td>
                                    <td onclick=\"deleteSeller('$var->name')\" class=\"btn btn-danger btn-xs\">Delete</td>

                                </tr>
            ";

        }
    }





    //LIsts shown for buying voucher
    public function BuyingVoucherListsPage(){
        $buyingVoucherLists= DB::table('buyingvoucher')->where('id', '>', 1)->get();
        return view('buyingVoucherLists')->withBuyingVoucherLists($buyingVoucherLists);

    }

    public function buyingVoucherDelete($voucherNo){
        DB::table('buyingvoucher')->where('voucherNo',$voucherNo)->delete();
        echo "1";

    }

    public function  buyingVoucherFetchDataAfterDelete(){

        $buyingVoucherList = DB::table('buyingvoucher')->where('id', '>', 1)->get();

        foreach ($buyingVoucherList as $var) {

            echo "
            
             <tr>
                                    <td>$var->sellerName</td>
                                    <td>$var->voucherNo</td>
                                    <td>$var->$var->date</td>
                                    <td ><a class=\"btn btn-success\">View</a> <a href=\"returnBroughtProduct/$var->voucherNo\" class=\"btn btn-primary\">Edit</a> <a onclick=\"buyingVoucherDelete('$var->voucherNo')\" class=\"btn btn-danger\">Delete</a></td>

                                </tr>
            
            ";

        }

    }




    //Bank list

    public function  bankListPage(){

        $bankData = DB::table('bankbalance')->get();
        return view('bankList')->withBankData($bankData);
    }

    public function deleteBank($bank){

        $bankBalance = DB::table('bankBalance')->where('bankName', $bank)->sum('balance');

        if($bankBalance>0){
            //Unable to delete
           echo "0" ;
        }else{
            //Yes able to delete all data of bank

            DB::table('bankBalance')->where('bankName',$bank)->delete();
            DB::table('bank')->where('bankName',$bank)->delete();
            DB::table('bankaccount')->where('bankName',$bank)->delete();
            echo "1";
        }

    }


    public function deleteAc($acName){

        $bankBalance = DB::table('bankBalance')->where('acName', $acName)->value('balance');

        if($bankBalance>0){
            //Unable to delete
            echo "0" ;
        }else{
            //Yes able to delete all data of bank

            DB::table('bankBalance')->where('acName',$acName)->delete();
            DB::table('bankaccount')->where('acName',$acName)->delete();
            echo "1";
        }



    }



    public function costList(){
        $cost= DB::table('dailycost')->get();
        return view('costLists')->withCost($cost);
    }

    public function deleteCost($id){
        //First deleting voucher
        DB::table('dailycost')->where('id',$id)->delete();
        echo "1";


    }





}

