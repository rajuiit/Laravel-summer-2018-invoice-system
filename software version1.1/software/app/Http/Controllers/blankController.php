<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class blankController extends Controller
{
<?php

namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use DB;
    use Carbon\Carbon;


class returnController extends Controller
{


    //* return code which product sold  *//
    public function returnpage($voucherNo)
    {
        $timeDateVar = new Carbon();
        $showingDate= $timeDateVar->toFormattedDateString();

        $mainDate = $timeDateVar->today();




        //Check if any data in editingcart delete

        $checkData = DB::table('editmodestatus')->value('status');

        if($checkData==1){
            //Delete editingcart table's data
            DB::table('editingcart')->delete();

            DB::table('editmodestatus')->update([
                'status' => 0
            ]);

        }
        DB::table('backupdeliveryproduct')->delete();


        $voucherData = DB::table('sellingvoucher')->where('voucherNo', $voucherNo)->first();

        $brand = DB::table('brand')->get();
        $model = DB::table('model')->get();
        $customer = DB::table('customer')->get();

        //prepearng voucher no when going to return  page
        $voucherNo = DB::table('sellingVoucher')->where('voucherNo', $voucherNo)->first();

        //taking datta of voucher
        $voucherNo = $voucherData->voucherNo;
        $customerName = $voucherData->customerName;
        $voucherDiscount = $voucherData->voucherDiscount;
        $payment = $voucherData->payment;
        $date = $voucherData->date;

        //passing data of voucher
        return view('return')->withBrand($brand)->withModel($model)->withCustomer($customer)->withVoucherNo($voucherNo)->withCustomerName($customerName)->withVoucherDiscount($voucherDiscount)->withPayment($payment)->withDate($date)->withMainDate($mainDate)->withShowingDate($showingDate);


    }

    public function addIntoReturn(Request $request)
    {

        //In database modelName is unique ....................

        $orderedQuantity = $request->input('quantity');
        $modelName = $request->input('modelName');
        $currentVoucherNo = $request->input('voucherNo');
        $date = $request->input('date');

        //Fetching quantity from storage for checking (available) product
        $remainingProduct = DB::table('storage')->where('modelName', $modelName)->value('quantity');


        // if Product is avaiable for buying ......
        if ($remainingProduct >= $orderedQuantity) {
            //Collecting all data from different table ............for ordered product
            $brand = DB::table('model')->where('modelName', $modelName)->value('brand');
            $price = DB::table('model')->where('modelName', $modelName)->value('sellingPrice');
            $type = DB::table('model')->where('modelName', $modelName)->value('type');
            $buyingPrice = DB::table('model')->where('modelName', $modelName)->value('buyingPrice');


            //After collecting data pushing it into cart database

            //Before pushing checking that if same mmodel existing ir not
            $existModelName = DB::table('editingcart')->where('modelName', $modelName)->where('voucherNo', $currentVoucherNo)->first();

            $orderedQuantityPrice = $orderedQuantity * $price;
            $orderedBuyingPrice = $orderedQuantity * $buyingPrice;


            //If not exist then insert
            if (!$existModelName) {

                DB::table('editingcart')->insert([
                    'brand' => $brand,
                    'modelName' => $modelName,
                    'type'   => $type,
                    'sellingPrice'  => $orderedQuantityPrice,
                    'quantity' => $orderedQuantity,
                    'buyingPrice' =>$orderedBuyingPrice,
                    'voucherNo'  => $currentVoucherNo,
                    'date' => $date
                ]);



                // 1 means something action happened
                echo "1";

            } //If exist then only add quantity with previous existing model and add price for total
            else {

                //finally updating cart after adding new product
                $orderedQuantityPrice = $orderedQuantity * $price;
                $orderedBuyingPrice = $orderedQuantity * $buyingPrice;


                DB::table('editingcart')->where('modelName', $modelName)->where('voucherNo', $currentVoucherNo)->update([
                    'brand' => $brand,
                    'modelName' => $modelName,
                    'type' => $type,
                    'sellingPrice' => $orderedQuantityPrice,
                    'quantity' => $orderedQuantity,
                    'buyingPrice' => $orderedBuyingPrice,
                    'voucherNo' => $currentVoucherNo,


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


        } //Product is not avaiable for so deny request;
        else {
            echo "0";
        }

    }

    public function returnCartDataFetch($voucherNo)
    {


        GLOBAL $initial;
        $loopTime = DB::table('deleveredproduct')->where('voucherNo', $voucherNo)->count();

        $editMode= DB::table('editmodestatus')->value('status');

        if($editMode == 0){
            for ($initial = 1; $initial <= $loopTime; $initial++) {


                //Database copying method start .................................
                //First taking all data from somewhere (deliver db) and keeping it on
                //backup datatable then deleting ...(as delete is mandatory)
                //Then taking data from backup and inserting into old()
                //As shifting data from delivered to cart table on only for first click so

                $previousData =  DB::table('deleveredproduct')->where('voucherNo',$voucherNo)->first();

                $brand = $previousData->brand;
                $modelName = $previousData->modelName;
                $type = $previousData->type;
                $sellingPRice = $previousData->sellingPrice;
                $quantity = $previousData->quantity;
                $buyingPrice = $previousData->buyingPrice;
                $id  = $previousData->id ;
                $date  = $previousData->date ;

                //Now inserting into cart

                DB::table('editingcart')->insert([
                    'brand' => $brand,
                    'modelName' => $modelName,
                    'type'   => $type,
                    'sellingPrice'  => $sellingPRice,
                    'quantity' => $quantity,
                    'buyingPrice' =>$buyingPrice,
                    'voucherNo'  => $voucherNo,
                    'date'       =>$date
                ]);

                //Inserting data to backup table

                DB::table('backupdeliveryproduct')->insert([
                    'brand' => $brand,
                    'modelName' => $modelName,
                    'type'   => $type,
                    'sellingPrice'  => $sellingPRice,
                    'quantity' => $quantity,
                    'buyingPrice' =>$buyingPrice,
                    'voucherNo'  => $voucherNo,
                    'date'      => $date
                ]);


                DB::table('deleveredproduct')->where('voucherNo',$voucherNo)->where('id',$id)->delete();


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

                //update value 1 to edie mode status table to understand that edit mode is one

                DB::table('editmodestatus')->where('id',1)->update([
                    'status' => 1
                ]);

                //Again keeping data backup table to delivered table()


                if ($initial == $loopTime) {
                    $cartData = DB::table('editingcart')->get();
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
                                            <td><a onclick='cartDelete('')' class='btn  btn-danger btn-sm'><i class='fa fa-trash-alt' ></i></a></td>
                                        </tr> ";
                    };


                }

            }
        }

        //If there is not any data which have been searched by parameter  then only fetch data....
        else{
            $cartData = DB::table('editingcart')->get();
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
                                            <td><a onclick='cartDelete('')' class='btn  btn-danger btn-sm'><i class='fa fa-trash-alt' ></i></a></td>
                                        </tr> ";
            };

        }


    }


    function cusInfoTracking($name){
        $cusData = DB::table('customer')->where('name',$name)->first();
        $cusName = $cusData->name;

        $currentPrice =  DB::table("editingcart")->sum('sellingPrice');
        $cusPrevDue =  DB::table('customer')->where('name',$cusName)->value('due');

        $updatedPrice =  $currentPrice+$cusPrevDue;

        echo "
        
    
                    
                    <div class=\"total\">
                        <p class=\"alert alert-success\"><b> Total : <span class='total-slog'>$updatedPrice tk</span></b></p>
                    </div>
            
                    <div class=\"prv - due\">
                        <p class='alert alert-danger'><b>Prev-Due : <span>$cusPrevDue tk</span></b></p>
                    </div>
           
                    <br>
                 
        
        
        ";


    }



    function cusInfoTrackingAfterClickingDataSend($name){
        $cusData = DB::table('customer')->where('name',$name)->first();
        $cusName = $cusData->name;

        $currentPrice =  DB::table("editingcart")->sum('sellingPrice');
        $cusPrevDue =  DB::table('customer')->where('name',$cusName)->value('due');

        $updatedPrice =  $currentPrice+$cusPrevDue;

        //After returing product the final price is

        //Fetcjing data from sellingvoucher for tracking whole price or payment for voucher

        $thisVoucherPreviousPrice = DB::table('sellingvoucher')->where('customerName',$cusName)->value('payment');
        $updatedPriceAfterReturn = ($currentPrice+$cusPrevDue)-$thisVoucherPreviousPrice;


        if($updatedPriceAfterReturn>0){

            echo "
        
                
                    <div class=\"total\">
                        <p class=\"alert alert-success\"><b> Total   : <span class='total-slog'>$updatedPrice tk</span></b></p>
                    </div>
            
                    <div class=\"prv - due\">
                        <p class='alert alert-danger'><b>Prev-Due : <span>$cusPrevDue tk</span></b></p>
                    </div>
                    <div class=\"prv - due\">
                        <p class='alert alert-warning'><b>Added Bill: <span> $updatedPriceAfterReturn tk</span></b></p>
                    </div>
           
                    <br>
                 
       
        ";

        }else{

            $updatedPriceAfterReturn = -($updatedPriceAfterReturn);
            echo "
        
    
               
                    <div class=\"total\">
                        <p class=\"alert alert-success\"><b> Total   : <span class='total-slog'>$updatedPrice tk </span> </b></p>
                    </div>
            
                    <div class=\"prv - due\">
                        <p class='alert alert-danger'><b>Prev-Due : <span>$cusPrevDue tk</span></b></p>
                    </div>
                    <div class=\"prv - due\">
                        <p class='alert alert-warning'><b>Client Get: <span>$updatedPriceAfterReturn tk</span></b></p>
                    </div>
           
                    <br>
                 
        
        
        ";


        }






    }


    public function  discountCounter($name, $paying, $discount,$voucherNo){

        $currentPrice =  DB::table("editingcart")->sum('sellingPrice');
        $cusPrevDue =  DB::table('customer')->where('name',$name)->value('due');
        $discount = ($discount/100)*$currentPrice;
        $priceAfterDiscount = $currentPrice-$discount;


        $prevPayment = DB::table('sellingvoucher')->where('voucherNo',$voucherNo)->value('payment');

        $updatedPriceAfterDiscount =  $priceAfterDiscount+$cusPrevDue;

        $finalPayment = $updatedPriceAfterDiscount-$prevPayment;

        // Add $updatedStillDueAfterDiscount with clients prev due if client does not clear full payment ....
        $updatedStillDueAfterDiscount= $finalPayment-$paying;
        DB::table('due')->update([
            'due' =>  $updatedStillDueAfterDiscount
        ]);

        if($updatedPriceAfterDiscount>=0){
            if($paying>$updatedPriceAfterDiscount){
                echo "0";
            }else{

                echo "
        
                
                    <div class=\"total\">
                        <p class=\"alert alert-success\"><b> Total   : <span class='total-slog'>$updatedPriceAfterDiscount tk</span></b></p>
                    </div>
            
                    <div class=\"prv - due\">
                        <p class='alert alert-danger'><b>Prev-Due : <span>$cusPrevDue tk</span></b></p>
                    </div>
                    <div class=\"prv - due\">
                        <p class='alert alert-warning'><b>Owner-get: <span> $finalPayment tk</span></b></p>
                    </div>
           
                    <br>
                 
       
        ";



                /*
                if($finalPayment>$prevPayment){

                    echo "


                    <div class=\"total\">
                        <p class=\"alert alert-success\"><b> Total   : <span class='total-slog'>$updatedPriceAfterDiscount tk</span></b></p>
                    </div>

                    <div class=\"prv - due\">
                        <p class='alert alert-danger'><b>Prev-Due : <span>$cusPrevDue tk</span></b></p>
                    </div>
                    <div class=\"prv - due\">
                        <p class='alert alert-warning'><b>Owner-get: <span> $finalPayment tk</span></b></p>
                    </div>

                    <br>


        ";

                }else{



                    echo "


                    <div class=\"total\">
                        <p class=\"alert alert-success\"><b> Total   : <span class='total-slog'>-($updatedPriceAfterDiscount) tk</span></b></p>
                    </div>

                    <div class=\"prv - due\">
                        <p class='alert alert-danger'><b>Prev-Due : <span>-($cusPrevDue) tk</span></b></p>
                    </div>
                    <div class=\"prv - due\">
                        <p class='alert alert-warning'><b>Client-get: <span> $finalPayment tk</span></b></p>
                    </div>

                    <br>


        ";
                } */


            }


        }else{

        }




    }


    function  checkProfite($discount){

        $checkCart = DB::table('editingcart')->count();
        if($checkCart >=1){

            $currentPrice =  DB::table("editingcart")->sum('sellingPrice');
            $buyingPrice =  DB::table("editingcart")->sum('buyingPrice');
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





    public function saveChanges (Request $request){



        $date = $request->input('date');
        $cusName = $request->input('selected-customer');
        $voucherNo = $request->input('voucherNo');
        $voucherDiscount = $request->input('voucherDiscount');
        $payment = $request->input('payment');

        //update voucher
        DB::table('sellingvoucher')->where('voucherNo',$voucherNo)->update([

            'payment'=>$payment,
            'voucherDiscount'=>$voucherDiscount
        ]);

        //Common for every modelName ----------------------------------------------------------------
        //Step no two taking data from cart cart and subvtracting data from main storage
        GLOBAL $initial;
        $loopTime = DB::table('editingcart')->count();


        for($initial=1; $initial <= $loopTime; $initial++){

            $editingCartData = DB::table('editingcart')->first();

            $getModelName = $editingCartData->modelName;
            $getQuantity = $editingCartData->quantity;
            $brand = $editingCartData->brand;
            $type = $editingCartData->type;
            $sellingPrice = $editingCartData->sellingPrice;
            $buyingPrice = $editingCartData->buyingPrice;
            $voucherNo = $editingCartData->voucherNo;
            $date = $editingCartData->date;

            //searching on delivered product database is same voucher and modelName exist or not
            $checkExistingData = DB::table('deleveredproduct')->where('voucherNo',$voucherNo)->where('modelName',$getModelName)->count();

            //Updating main storage started----------------------------------------------------------------------------
            //----------------------------------------------------
            //---------------------

            if($checkExistingData>0){

                $getQuantityOfDeliveredTable = DB::table('deleveredproduct')->where('voucherNo',$voucherNo)->where('modelName',$getModelName)->value('quantity');

                $modifiedQuantity = $getQuantity-$getQuantityOfDeliveredTable;


                if($modifiedQuantity>0){
                    //That means ordered added more quantity so, added things should substract from storage

                    //Fetching Data form storage
                    $storageQuantity = DB::table('storage')->where('modelName',$getModelName)->value('quantity');

                    //Subtracting new added value with storage quantity
                    $updatedQunatityAfterReturn = $storageQuantity -$modifiedQuantity;

                    DB::table('storage')->where('modelName',$getModelName)->update([
                        'quantity' => $updatedQunatityAfterReturn
                    ]);




                }  else{
                    //That means ordered added more quantity so, added things should substract from storage

                    //Fetching Data form storage
                    $storageQuantity = DB::table('storage')->where('modelName',$getModelName)->value('quantity');

                    //Subtracting new added value with storage quantity
                    $updatedQunatityAfterReturn = $storageQuantity +(-$modifiedQuantity);

                    DB::table('storage')->where('modelName',$getModelName)->update([
                        'quantity' => $updatedQunatityAfterReturn
                    ]);



                }

                DB::table('deleveredproduct')->where('voucherNo',$voucherNo)->where('modelName',$getModelName)->delete();

                DB::table('deleveredproduct')->insert([
                    'brand' => $brand,
                    'modelName' => $getModelName,
                    'type'   => $type,
                    'sellingPrice'  => $sellingPrice,
                    'quantity' => $getQuantity,
                    'buyingPrice' =>$buyingPrice,
                    'voucherNo'  => $voucherNo,
                    'date'  => $date
                ]);

                //Deleting first data from editing cart
                DB::table('editingcart')->where('voucherNo',$voucherNo)->where('modelName',$getModelName)->delete();



            }

            //Updating main storage finished----------------------------------------------------------------------------
            //----------------------------------------------------
            //---------------------

            else{
                //insert into delivered table
                DB::table('deleveredproduct')->insert([
                    'brand' => $brand,
                    'modelName' => $getModelName,
                    'type'   => $type,
                    'sellingPrice'  => $sellingPrice,
                    'quantity' => $getQuantity,
                    'buyingPrice' =>$buyingPrice,
                    'voucherNo'  => $voucherNo,
                    'date' =>$date
                ]);

                //Deleting first data from editing cart
                DB::table('editingcart')->where('voucherNo',$voucherNo)->where('modelName',$getModelName)->delete();



            }

            //-------------------

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
            //------------------------

        }



    }





    //* return code which product I brought  *//



    public function  returnBroughtProductPage($voucherNo){



        //Check if any data in editingcart delete

        $checkData = DB::table('editmodestatus')->value('status');


        if($checkData==1){
            //Delete editingcart table's data
            DB::table('buyeditingcart')->delete();

            DB::table('editmodestatus')->update([
                'status' => 0
            ]);

        }

        DB::table('backupbroughtproduct')->delete();


        $voucherData = DB::table('buyingvoucher')->where('voucherNo', $voucherNo)->first();

        $brand = DB::table('brand')->get();
        $model = DB::table('model')->get();
        $seller = DB::table('seller')->get();

        //prepearng voucher no when going to return  page

        //taking datta of voucher
        $voucherNo = $voucherData->voucherNo;
        $sellerName = $voucherData->sellerName;
        $voucherDiscount = $voucherData->voucherDiscount;
        $payment = $voucherData->payment;
        $date = $voucherData->date;
        $myBill = $voucherData->myBill;
        $sellersVoucher = $voucherData->sellersVoucherNo;

        //passing data of voucher
        return view('returnBroughtProduct')->withBrand($brand)->withModel($model)->withSellerName($sellerName)->withVoucherNo($voucherNo)->withSeller($seller)->withVoucherDiscount($voucherDiscount)->withPayment($payment)->withDate($date)->withMyBill($myBill)->withSellersVoucher($sellersVoucher);



    }



    public function addIntoMyReturn(Request $request)
    {

        //In database modelName is unique ....................

        $orderedQuantity = $request->input('quantity');
        $modelName = $request->input('modelName');
        $currentVoucherNo = $request->input('voucherNo');
        $date = $request->input('date');

        //Fetching quantity from storage for checking (available) product
        $remainingProduct = DB::table('storage')->where('modelName', $modelName)->value('quantity');

        if($remainingProduct<$orderedQuantity){
            echo "0";
        }else{
            // if Product is avaiable for buying ......

            //Collecting all data from different table ............for ordered product
            $brand = DB::table('model')->where('modelName', $modelName)->value('brand');
            $price = DB::table('model')->where('modelName', $modelName)->value('sellingPrice');
            $type = DB::table('model')->where('modelName', $modelName)->value('type');
            $buyingPrice = DB::table('model')->where('modelName', $modelName)->value('buyingPrice');


            //After collecting data pushing it into cart database

            //Before pushing checking that if same mmodel existing ir not
            $existModelName = DB::table('buyeditingcart')->where('modelName', $modelName)->where('voucherNo', $currentVoucherNo)->first();

            //   $orderedQuantityPrice = $orderedQuantity * $price;
            //   $orderedBuyingPrice = $orderedQuantity * $buyingPrice;


            //If not exist then insert
            if (!$existModelName) {

                DB::table('buyeditingcart')->insert([
                    'brand' => $brand,
                    'modelName' => $modelName,
                    'type'   => $type,
                    'quantity' => $orderedQuantity,
                    'voucherNo'  => $currentVoucherNo,
                    'date'      => $date
                ]);



                // 1 means something action happened
                echo "1";

            } //If exist then only add quantity with previous existing model and add price for total
            else {

                //finally updating cart after adding new product
                //       $orderedQuantityPrice = $orderedQuantity * $price;
                //     $orderedBuyingPrice = $orderedQuantity * $buyingPrice;


                DB::table('buyeditingcart')->where('modelName', $modelName)->where('voucherNo', $currentVoucherNo)->update([
                    'brand' => $brand,
                    'modelName' => $modelName,
                    'type' => $type,
                    'quantity' => $orderedQuantity,
                    'voucherNo' => $currentVoucherNo,


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


    }


    public function MyReturnCartDataFetch($voucherNo)
    {


        GLOBAL $initial;
        $loopTime = DB::table('broughtproduct')->where('voucherNo', $voucherNo)->count();

        $editMode= DB::table('editmodestatus')->value('status');

        if($editMode == 0){
            for ($initial = 1; $initial <= $loopTime; $initial++) {


                //Database copying method start .................................
                //First taking all data from somewhere (deliver db) and keeping it on
                //backup datatable then deleting ...(as delete is mandatory)
                //Then taking data from backup and inserting into old()
                //As shifting data from delivered to cart table on only for first click so

                $previousData =  DB::table('broughtproduct')->where('voucherNo',$voucherNo)->first();

                $brand = $previousData->brand;
                $modelName = $previousData->modelName;
                $type = $previousData->type;
                $quantity = $previousData->quantity;
                $id  = $previousData->id ;
                $date = $previousData->date;

                //Now inserting into cart

                DB::table('buyeditingcart')->insert([
                    'brand' => $brand,
                    'modelName' => $modelName,
                    'type'   => $type,
                    'quantity' => $quantity,
                    'voucherNo'  => $voucherNo,
                    'date' =>$date
                ]);

                //Inserting data to backup table

                DB::table('backupbroughtproduct')->insert([
                    'brand' => $brand,
                    'modelName' => $modelName,
                    'type'   => $type,
                    'quantity' => $quantity,
                    'voucherNo'  => $voucherNo,
                    'date' =>$date
                ]);


                DB::table('broughtproduct')->where('voucherNo',$voucherNo)->where('id',$id)->delete();


                DB::table('broughtproduct')->insert([
                    'brand' => $brand,
                    'modelName' => $modelName,
                    'type'   => $type,
                    'quantity' => $quantity,
                    'voucherNo'  => $voucherNo,
                    'date' =>$date
                ]);

                //update value 1 to edie mode status table to understand that edit mode is one

                DB::table('editmodestatus')->where('id',1)->update([
                    'status' => 1
                ]);

                //Again keeping data backup table to delivered table()


                if ($initial == $loopTime) {
                    $cartData = DB::table('buyeditingcart')->get();
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

            }
        }

        //If there is not any data which have been searched by parameter  then only fetch data....
        else{
            $cartData = DB::table('buyeditingcart')->get();
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



    }





    public function returnBroughtsaveChanges (Request $request){



        $date = $request->input('date');
        $cusName = $request->input('selected-customer');
        $voucherNo = $request->input('voucherNo');
        $voucherDiscount = $request->input('voucherDiscount');
        $payment = $request->input('payment');
        $myBill = $request->input('myBill');
        $paid = $request->input('paid');
        $sellersVoucher = $request->input('sellersVoucher');

        //update voucher
        DB::table('buyingvoucher')->where('voucherNo',$voucherNo)->update([

            'payment'=>$payment,
            'myBill'=>$myBill,
            'sellersVoucherNo'=>$sellersVoucher,
            'voucherDiscount' =>$voucherDiscount


        ]);

        //Common for every modelName ----------------------------------------------------------------
        //Step no two taking data from cart cart and subvtracting data from main storage
        GLOBAL $initial;
        $loopTime = DB::table('buyeditingcart')->count();


        for($initial=1; $initial <= $loopTime; $initial++){

            $editingCartData = DB::table('buyeditingcart')->first();

            $getModelName = $editingCartData->modelName;
            $getQuantity = $editingCartData->quantity;
            $brand = $editingCartData->brand;
            $type = $editingCartData->type;
            $voucherNo = $editingCartData->voucherNo;
            $date = $editingCartData->date;

            //searching on delivered product database is same voucher and modelName exist or not
            $checkExistingData = DB::table('broughtproduct')->where('voucherNo',$voucherNo)->where('modelName',$getModelName)->count();

            //Updating main storage started----------------------------------------------------------------------------
            //----------------------------------------------------
            //---------------------

            if($checkExistingData>0){

                $getQuantityOfDeliveredTable = DB::table('broughtproduct')->where('voucherNo',$voucherNo)->where('modelName',$getModelName)->value('quantity');

                $modifiedQuantity = $getQuantity-$getQuantityOfDeliveredTable;


                if($modifiedQuantity>0){
                    //That means ordered added more quantity so, added things should substract from storage

                    //Fetching Data form storage
                    $storageQuantity = DB::table('storage')->where('modelName',$getModelName)->value('quantity');

                    //Subtracting new added value with storage quantity
                    $updatedQunatityAfterReturn = $storageQuantity +$modifiedQuantity;

                    DB::table('storage')->where('modelName',$getModelName)->update([
                        'quantity' => $updatedQunatityAfterReturn
                    ]);




                }  else{
                    //That means ordered added more quantity so, added things should substract from storage

                    //Fetching Data form storage
                    $storageQuantity = DB::table('storage')->where('modelName',$getModelName)->value('quantity');

                    //Subtracting new added value with storage quantity

                    $updatedQunatityAfterReturn = $storageQuantity -(-$modifiedQuantity);

                    DB::table('storage')->where('modelName',$getModelName)->update([
                        'quantity' => $updatedQunatityAfterReturn
                    ]);



                }

                DB::table('broughtproduct')->where('voucherNo',$voucherNo)->where('modelName',$getModelName)->delete();

                DB::table('broughtproduct')->insert([
                    'brand' => $brand,
                    'modelName' => $getModelName,
                    'type'   => $type,
                    'quantity' => $getQuantity,
                    'voucherNo'  => $voucherNo,
                    'date' =>$date
                ]);

                //Deleting first data from editing cart
                DB::table('buyeditingcart')->where('voucherNo',$voucherNo)->where('modelName',$getModelName)->delete();



            }

            //Updating main storage finished----------------------------------------------------------------------------
            //----------------------------------------------------
            //---------------------

            else{
                //insert into delivered table
                DB::table('broughtproduct')->insert([
                    'brand' => $brand,
                    'modelName' => $getModelName,
                    'type'   => $type,
                    'quantity' => $getQuantity,
                    'voucherNo'  => $voucherNo,
                    'date' =>$date
                ]);

                //Deleting first data from editing cart
                DB::table('buyeditingcart')->where('voucherNo',$voucherNo)->where('modelName',$getModelName)->delete();



            }

            //-------------------

            if($initial == $loopTime){

                //If customer have due then it should be add with prev due of this customer

                $cusRecentDue = DB::table('due')->where('id',1)->value('due');



                //updating clients due
                DB::table('seller')->where('name',$cusName)->update([
                    'get' => $cusRecentDue
                ]);

                //Confirming that delivery operation is completed and returning data to ajax
                echo "1";
            }
            //------------------------

        }



    }


    public function discountCounterForBroughtReturn($name, $paying,$voucherNo, $myBill){


        $myPrevDue =  DB::table('seller')->where('name',$name)->value('get');


        $paidBefore =  DB::table('buyingvoucher')->where('voucherNo',$voucherNo)->value('payment');

        $currentBill = ($myBill + $myPrevDue)-$paidBefore;



        // Add $updatedStillDueAfterDiscount with clients prev due if client does not clear full payment ....
        $updatedStillDue= $currentBill-$paying;
        DB::table('due')->update([
            'due' =>  $updatedStillDue
        ]);

        if($currentBill>=0){



            echo "
        
                
                    <div class=\"total\">
                        <p class=\"alert alert-success\"><b> Pay More   : <span class='total-slog'>$currentBill tk</span></b></p>
                    </div>
            
                    <div class=\"prv - due\">
                        <p class='alert alert-danger'><b>My-Prev-Due : <span>$myPrevDue tk</span></b></p>
                    </div>
                    
                    
             
                 
       
        ";







        }else{

            $currentBill = -($currentBill);
            echo "
              
                
                    <div class=\"total\">
                        <p class=\"alert alert-success\"><b>Get Back   : <span class='total-slog'>$currentBill tk</span></b></p>
                    </div>
            
                    <div class=\"prv - due\">
                        <p class='alert alert-danger'><b>My-Prev-Due : <span>$myPrevDue tk</span></b></p>
                    </div>
                
                 
       
        ";





        }







    }






}
