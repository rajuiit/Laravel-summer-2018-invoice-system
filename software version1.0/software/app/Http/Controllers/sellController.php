<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;

class sellController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function  sellPage(){

        //IF any data inside cart then delete it
        $timeDateVar = new Carbon();
      //  $timeDateVar = Carbon::now(new DateTimeZone('Asia/Bangladesh'));

    //  $timeZone =  $tz->toRegionTimeZone();
        $showingDate= $timeDateVar->toFormattedDateString();

        $mainDate = $timeDateVar->today();

        //Taking date from carbn


        $checkData = DB::table('cart')->count();
        if($checkData){
            DB::table('cart')->delete();
        }


        $brand = DB::table('brand')->get();
        $model = DB::table('model')->get();
        $customer = DB::table('customer')->get();

        //prepearng voucher no when going to sell page
        $voucherNo = DB::table('sellingVoucher')->orderBy('id', 'desc')->first();

        //setting up id when no data in selling voucher
        $checkDataInsellingVoucher = DB::table('sellingVoucher')->count();

        $nextVoucherNo =  $voucherNo->id+1 ;
        $nextVoucherNo = "voucher$nextVoucherNo";

        return view('sell')->withBrand($brand)->withModel($model)->withCustomer($customer)->withNextVoucherNo($nextVoucherNo)->withShowingDate($showingDate)->withMainDate($mainDate);

    }


    public function addToCart(Request $request){


        //In database mokdelName is unique ....................

        $orderedQuantity = $request->input('quantity');
        $modelName = $request->input('modelName');
        $voucherNo = $request->input('voucherNo');
        $date = $request->input('date');

        //Fetching quantity from storage for checking (available) product
        $remainingProduct = DB::table('storage')->where('modelName',$modelName)->value('quantity');


        // if Product is avaiable for buying ......
        if($remainingProduct >= $orderedQuantity){
            //Collecting all data from different table ............for ordered product
            $brand = DB::table('model')->where('modelName',$modelName)->value('brand');
            $price = DB::table('model')->where('modelName',$modelName)->value('sellingPrice');
            $type = DB::table('model')->where('modelName',$modelName)->value('type');
            $buyingPrice = DB::table('model')->where('modelName',$modelName)->value('buyingPrice');


            //After collecting data pushing it into cart database

            //Before pushing checking that if same mmodel existing ir not
            $existModelName = DB::table('cart')->where('modelName', $modelName)->first();

            $orderedQuantityPrice =  $orderedQuantity* $price;
            $orderedBuyingPrice =  $orderedQuantity* $buyingPrice;


            //If not exist then insert
            if(!$existModelName){
                DB::table('cart')->insert([
                    'brand' => $brand,
                    'modelName' => $modelName,
                    'type'   => $type,
                    'sellingPrice'  => $orderedQuantityPrice,
                    'quantity' => $orderedQuantity,
                    'buyingPrice' =>$orderedBuyingPrice,
                    'voucherNo'  => $voucherNo,
                    'date'      => $date
                ]);



                // 1 means something action happened
                echo "1";

            }


            //If exist then only add quantity with previous existing model and add price for total
            else{

                //finally updating cart after adding new product
                $orderedQuantityPrice = $orderedQuantity* $price;
                $orderedBuyingPrice =  $orderedQuantity* $buyingPrice;



              DB::table('cart')->where('modelName', $modelName)->where('voucherNo',$voucherNo)->update([
                        'brand' => $brand,
                        'modelName' => $modelName,
                        'type'   => $type,
                        'sellingPrice' => $orderedQuantityPrice,
                        'quantity' => $orderedQuantity,
                        'buyingPrice' =>$orderedBuyingPrice,
                        'voucherNo'  => $voucherNo

                ]);


                // 1 means something action happened
                echo "1";





                /* Take this part for deliver --------------
                //Code for Updating remaining product in storage after adding to cart started ---------------------------------------
                $numberOfAddedProduct= DB::table('cart')->where('modelName',$modelName)->value('quantity');
                $quantityInStorage = DB::table('storage')->where('modelName',$modelName)->value('quantity');

                //So remaining product in storage
                $updateStorageQuantity = $quantityInStorage - $numberOfAddedProduct;

                //Finally update quantity in storage
                DB::table('storage')->where('modelName',$modelName)->update([
                    'quantity' => $updateStorageQuantity
                ]);

                //Code for Updating product in storage after adding to cart finished---------------------------------------

 */
            }


        }

        //Product is not avaiable for so deny request;
        else{
            echo "Not available";
        }



    }


//Fetching data when user clicking on cart button
    function cartDataFetch(){

         $cartBill = DB::table('cart')->sum('sellingPrice');
         $cartData = DB::table('cart')->get();
         $rowNo =0;


        foreach ($cartData as $var){
            $rowNo++;
            echo"                       <tr>
                                            <th scope=\'row\'>$rowNo</th>
                                            <td>$var->brand</td>
                                            <td>$var->modelName</td>
                                            <td>$var->type</td>
                                            <td>$var->quantity</td>
                                            <td>$var->sellingPrice</td>
                                        </tr> 
                                                                       
                                         ";

        };


    }


    function cusInfoTracking($name){

        if($name){
            $cusData = DB::table('customer')->where('name',$name)->first();
            $cusName = $cusData->name;

            $currentPrice =  DB::table("cart")->sum('sellingPrice');
            $cusPrevDue =  DB::table('customer')->where('name',$cusName)->value('due');

            $updatedPrice =  $currentPrice+$cusPrevDue;

            echo "
        
    
                    
                    <div class=\"total\">
                        <p class=\"alert alert-success\"><b>BIll : <span class='total-slog'>$updatedPrice tk</span></b></p>
                    </div>
                  
            
                    <div class=\"prv - due\">
                        <p class='alert alert-danger'><b>Prev-Due : <span>$cusPrevDue tk</span></b></p>
                    </div>
           
                    <br>
                 
        
        
        ";
        }else{
            $currentPrice =  DB::table("cart")->sum('sellingPrice');

            echo "
        
    
                    
                    <div class=\"total\">
                        <p class=\"alert alert-success\"><b>BIll : <span class='total-slog'>$currentPrice tk</span></b></p>
                    </div>
                  
         
        
        ";
        }



    }

    /*
    function instantCusInfoTracking($mobileNo){
        $cusData = DB::table('customer')->where('mobile',$mobileNo)->first();
        $cusName = $cusData->name;

        $currentPrice =  DB::table("cart")->sum('sellingPrice');
        $cusPrevDue =  DB::table('customer')->where('name',$cusName)->value('due');

        $updatedPrice =  $currentPrice+$cusPrevDue;

        echo "



                    <div class=\"total\">
                        <p class=\"alert alert-success\"><b>BIll : <span class='total-slog'>$updatedPrice tk</span></b></p>
                    </div>


                    <div class=\"prv - due\">
                        <p class='alert alert-danger'><b>Prev-Due : <span>$cusPrevDue tk</span></b></p>
                    </div>

                    <br>



        ";


    } */

    public function dueCounter($paying,$name){

        $cusData = DB::table('customer')->where('name',$name)->first();
        $cusName = $cusData->name;
        $cusPrevDue =  DB::table('customer')->where('name',$cusName)->value('due');
        $currentPrice =  DB::table("cart")->sum('sellingPrice');
        $updatedPrice =  $currentPrice+$cusPrevDue;

        if($paying>$updatedPrice){
           echo "Sorry you can  not pay more than your valid price";
        } else{

            $stillDue =  ($currentPrice+$cusPrevDue) - $paying;
            echo "$stillDue";

        }

    }

    public function  discountCounter($name, $paying, $discount){

        $currentPrice =  DB::table("cart")->sum('sellingPrice');
        $cusPrevDue =  DB::table('customer')->where('name',$name)->value('due');
        $discount = ($discount/100)*$currentPrice;
        $priceAfterDiscount = $currentPrice-$discount;

        $updatedPriceAfterDiscount =  $priceAfterDiscount+$cusPrevDue;


        // Add $updatedStillDueAfterDiscount with clients prev due if client does not clear full payment ....
        $updatedStillDueAfterDiscount= $updatedPriceAfterDiscount-$paying;
        DB::table('due')->update([
           'due' =>  $updatedStillDueAfterDiscount
        ]);

       if($updatedStillDueAfterDiscount<0){
           echo "0";
       }else{
           echo "$updatedPriceAfterDiscount";
       }


    }

    function  checkProfite($discount){

        $checkCart = DB::table('cart')->count();
        if($checkCart >=1){

            $currentPrice =  DB::table("cart")->sum('sellingPrice');
            $buyingPrice =  DB::table("cart")->sum('buyingPrice');
            $discount = ($discount/100)*$currentPrice;
            $priceAfterDiscount = $currentPrice-$discount;
            $result =  $priceAfterDiscount-$buyingPrice;
            echo "$result";
        }
        else{
            $result= 'NAN';
            echo "$result";
        }


    }

    function deliver(Request $request){

        //checking if user click on deliver now without adding product on cart
        $cartDataCheck = DB::table('cart')->count();
        if($cartDataCheck>0){

                      $date = $request->input('date');
                      $mainDate= $request->input('mainDate');
                      $cusName = $request->input('customerName');
                      $voucherNo = $request->input('voucherNo');
                      $voucherDiscount = $request->input('voucherDiscount');
                      $payment = $request->input('payment');
                      $mobile = $request->input('mobile-no');

                      if($cusName=='0'){
                          $no = DB::table('sellingVoucher')->orderBy('id', 'desc')->first();
                          $nextNo =  $no->id+1 ;
                          $cusName = 'customer'.$nextNo;







                      }else{
                          $date = $request->input('date');
                          $mainDate= $request->input('mainDate');
                          $cusName = $request->input('customerName');
                          $voucherNo = $request->input('voucherNo');
                          $voucherDiscount = $request->input('voucherDiscount');
                          $payment = $request->input('payment');
                          $mobile = $request->input('mobile-no');
                      }





                      //inserting data to voucher data table

                      DB::table('sellingvoucher')->insert([

                          'date' => $date,
                          'mainDate'=>$mainDate,
                          'customerName' =>$cusName,
                          'voucherNo' =>  $voucherNo,
                          'voucherDiscount' => $voucherDiscount,
                          'payment'    => $payment,
                          'cashCounter' =>0,
                          'mobile' =>  $mobile



                      ]);



                      //Step no two taking data from cart cart and subvtracting data from main storage
                      GLOBAL $initial;
                      $loopTime = DB::table('cart')->count();


                       for($initial=1; $initial <= $loopTime; $initial++){


                           //Delivering product by fetching from cart and inserting to deliver db

                           $productInCart = DB::table('cart')->first();


                           $brand = $productInCart->brand;
                           $modelName = $productInCart->modelName;
                           $type = $productInCart->type;
                           $sellingPRice = $productInCart->sellingPrice;
                           $quantity = $productInCart->quantity;
                           $buyingPrice = $productInCart->buyingPrice;
                           $date = $productInCart->date;

                           //Now inserting into deliver db....

                           DB::table('deleveredproduct')->insert([
                               'brand' => $brand,
                               'modelName' => $modelName,
                               'type'   => $type,
                               'sellingPrice'  => $sellingPRice,
                               'quantity' => $quantity,
                               'buyingPrice' =>$buyingPrice,
                               'voucherNo'  => $voucherNo,
                               'date' => $date
                           ]);




                           //fetching modelName  data from cart
                                   $fetchingModelName = DB::table('cart')->first();
                                   $fetchingModelName= $fetchingModelName->modelName;

                                   //fetching quantity
                                   $fetchingQuantity = DB::table('cart')->first();
                                   $fetchingQuantity = $fetchingQuantity->quantity;


                                   $fetchingQuantityFromStorage = DB::table('storage')->where('modelName', $fetchingModelName)->value('quantity');

                                   $remainQuantityInStorage = $fetchingQuantityFromStorage - $fetchingQuantity;

                                   DB::table('storage')->where('modelName', $fetchingModelName)->update([
                                       'quantity' =>$remainQuantityInStorage
                                   ]);

                                   //now deleting first data (which calcualtion have finished)

                                   DB::table('cart')->where('modelName',$fetchingModelName)->delete();


                                 if($initial == $loopTime){

                                     //If customer have due then it should be add with prev due of this customer

                                     $cusRecentDue = DB::table('due')->where('id',1)->value('due');



                                     //updating clients due
                                     DB::table('customer')->where('name',$cusName)->update([
                                         'due' => $cusRecentDue
                                     ]);

                              //Confirming that delivery operation is completed and returning data to ajax
                                     echo "1";
                                 }

                      }

        }

        else{
            echo "0";
        }





    }


    function  cancelDelivery (){
        // step no 1 deleting temp data table cart's data
        DB::table('cart')->delete();

        //returning  value to ajax
        echo "1";

    }


}
