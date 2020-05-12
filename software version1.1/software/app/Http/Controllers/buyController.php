<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


class buyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function  buyPage(){

        $timeDateVar = new Carbon();
        $showingDate= $timeDateVar->toFormattedDateString();

        $mainDate = $timeDateVar->today();

        //Taking date from carbn

        //IF any data inside cart then delete it
        $checkData = DB::table('buyingcart')->count();
        if($checkData){
            DB::table('buyingcart')->delete();
        }


        $brand = DB::table('brand')->get();
        $model = DB::table('model')->get();
        $seller = DB::table('seller')->get();

        //prepearng voucher no when going to sell page
        $voucherNo = DB::table('buyingvoucher')->orderBy('id', 'desc')->first();

        //setting up id when no data in selling voucher
        $checkDataInsellingVoucher = DB::table('buyingvoucher')->count();

        $nextVoucherNo =  $voucherNo->id+1 ;
        $nextVoucherNo = "voucher$nextVoucherNo";

        return view('buy')->withBrand($brand)->withModel($model)->withSeller($seller)->withNextVoucherNo($nextVoucherNo)->withShowingDate($showingDate)->withMainDate($mainDate);

    }


    public function addToCart(Request $request){


        //In database mokdelName is unique ....................
        $orderedQuantity = $request->input('quantity');
        $modelName = $request->input('modelName');
        $voucherNo = $request->input('voucherNo');
        $date = $request->input('date');


        //Fetching quantity from storage for checking (available) product
       // $remainingProduct = DB::table('storage')->where('modelName',$modelName)->value('quantity');


        // if Product is avaiable for buying ......
            //Collecting all data from different table ............for ordered product

            $brand = DB::table('model')->where('modelName',$modelName)->value('brand');
            $type = DB::table('model')->where('modelName',$modelName)->value('type');


            //After collecting data pushing it into cart database

            //Before pushing checking that if same mmodel existing ir not
            $existModelName = DB::table('buyingcart')->where('modelName', $modelName)->first();



            //If not exist then insert
            if(!$existModelName){
                DB::table('buyingcart')->insert([
                    'brand' => $brand,
                    'modelName' => $modelName,
                    'type'   => $type,
                    'quantity' => $orderedQuantity,
                    'voucherNo'  => $voucherNo,
                    'date' =>$date

                ]);



                // 1 means something action happened
                echo "1";

            }


            //If exist then only add quantity with previous existing model and add price for total
            else{



                DB::table('buyingcart')->where('modelName', $modelName)->where('voucherNo',$voucherNo)->update([
                    'brand' => $brand,
                    'modelName' => $modelName,
                    'type'   => $type,
                    'quantity' => $orderedQuantity,
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


//Fetching data when user clicking on cart button
    function buyingCartDataFetch(){
        $cartData = DB::table('buyingcart')->get();
        $rowNo =0;


        foreach ($cartData as $var){
            $rowNo++;
            echo"                       <tr>
                                            <th scope=\'row\'>$rowNo</th>
                                            <td>$var->brand</td>
                                            <td>$var->modelName</td>
                                            <td>$var->type</td>
                                            <td>$var->quantity</td>
                                        </tr> ";
        };


    }


    function sellerInfoTracking($name, $myBill){
        $sellerData = DB::table('seller')->where('name',$name)->first();
        $sellerName = $sellerData->name;

        $sellerPrevget =  DB::table('seller')->where('name',$sellerName)->value('get');

        $updatedPrice =  $myBill+$sellerPrevget;

        if($sellerPrevget>0){
            echo "
        
                   <div class=\"total\">
                        <p class=\"alert alert-success\"><b> Total-Bill : <span class='total-slog'>$updatedPrice tk</span></b></p>
                    </div>
                    
            
                    <div class=\"prv - due\">
                        <p class='alert alert-danger'><b>My Prev-Due  : <span>$sellerPrevget tk</span></b></p>
                    </div>
           
                    <br>
                 
        
        
        ";
        }else{
            $sellerPrevget = -($sellerPrevget);

            echo "
        
                    
                   <div class=\"total\">
                        <p class=\"alert alert-success\"><b> $name get : <span class='total-slog'>$updatedPrice tk</span></b></p>
                    </div>
                    
            
                    <div class=\"prv - due\">
                        <p class='alert alert-danger'><b> I got : <span>$sellerPrevget tk</span></b></p>
                    </div>
           
                    <br>
                 
        
        
        ";
        }



    }



    public function  discountCounter($name, $paying, $myBill){

        $myBillToPay = $myBill;
        $sellerGet =  DB::table('seller')->where('name',$name)->value('get');
     //   $priceAfterDiscount = $myBillToPay-$discount;

        $checkingGet =  $myBill+$sellerGet;


        // Add $updatedStillDueAfterDiscount with clients prev due if client does not clear full payment ....
        $updatedStillGet= $checkingGet-$paying;
        DB::table('due')->update([
            'due' =>  $updatedStillGet
        ]);

        if($updatedStillGet<0){
            echo "0";
        }else{
            echo "$updatedStillGet";
        }


    }



    function deliver(Request $request)
    {

        //checking if user click on deliver now without adding product on cart
        $cartDataCheck = DB::table('buyingcart')->count();
        if ($cartDataCheck > 0) {

            $date = $request->input('date');
            $sellerName = $request->input('sellerName');
            $voucherNo = $request->input('voucherNo');
            $voucherDiscount = $request->input('voucherDiscount');
            $payment = $request->input('payment');
            $sellersVoucher = $request->input('sellersVoucherNo');
            $myBill = $request->input('myBill');




                        //inserting data to voucher data table


                        DB::table('buyingvoucher')->insert([

                            'date' => $date,
                            'sellerName' =>$sellerName,
                            'voucherNo' =>  $voucherNo,
                            'voucherDiscount' => $voucherDiscount,
                            'payment'    => $payment,
                            'sellersVoucherNo' => $sellersVoucher,
                            'myBill' => $myBill,


                        ]);



                                   //Step no two taking data from cart cart and subvtracting data from main storage
                                   GLOBAL $initial;
                                   $loopTime = DB::table('buyingcart')->count();


                                   for($initial=1; $initial <= $loopTime; $initial++){


                                       //Delivering product by fetching from cart and inserting to deliver db

                                       $productInCart = DB::table('buyingcart')->first();

                                       $brand = $productInCart->brand;
                                       $modelName = $productInCart->modelName;
                                       $type = $productInCart->type;
                                       $quantity = $productInCart->quantity;
                                       $date = $productInCart->date;

                                       //Now inserting into deliver db....

                                       DB::table('broughtproduct')->insert([
                                           'brand' => $brand,
                                           'modelName' => $modelName,
                                           'type'   => $type,
                                           'quantity' => $quantity,
                                           'voucherNo'  => $voucherNo,
                                           'date' => $date,
                                           'myBill'=> $myBill
                                       ]);

                                       //Now inserting to storage




                                       //fetching modelName  data from cart
                                       $fetchingModelName = DB::table('buyingcart')->first();
                                       $fetchingModelName= $fetchingModelName->modelName;

                                        $matchModelName = DB::table('storage')->where('modelName',$fetchingModelName)->count();
                                       if(!$matchModelName){
                                           DB::table('storage')->insert([
                                               'brand' => $brand,
                                               'modelName' => $modelName,
                                               'type'   => $type,
                                               'quantity' => $quantity
                                           ]);
                                       } else{

                                           //fetching quantity
                                           $fetchingQuantity = DB::table('buyingcart')->first();
                                           $fetchingQuantity = $fetchingQuantity->quantity;


                                           $fetchingQuantityFromStorage = DB::table('storage')->where('modelName', $fetchingModelName)->value('quantity');

                                           $remainQuantityInStorage = $fetchingQuantityFromStorage + $fetchingQuantity;

                                           DB::table('storage')->where('modelName', $fetchingModelName)->update([
                                               'quantity' =>$remainQuantityInStorage
                                           ]);

                                       }


                                       //now deleting first data (which calcualtion have finished)

                                       DB::table('buyingcart')->where('modelName',$fetchingModelName)->delete();


                                       if($initial == $loopTime){

                                           //If customer have due then it should be add with prev due of this customer

                                           $sellerGet = DB::table('due')->where('id',1)->value('due');



                                           //updating clients due
                                           DB::table('seller')->where('name',$sellerName)->update([
                                               'get' => $sellerGet
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
