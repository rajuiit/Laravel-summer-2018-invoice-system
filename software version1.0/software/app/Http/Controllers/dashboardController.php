<?php

namespace App\Http\Controllers;

use function foo\func;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class dashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboardPage()
    {


        //taking time info for todays analysis part

        $timeDateVar = new Carbon();
        $today = $timeDateVar->toFormattedDateString();
        $year = $timeDateVar->year;

        //Taking Date from carbon ended here

        $todaysBrought = DB::table('buyingvoucher')->where('date', $today)->sum('myBill');
        $todaysQuantity = DB::table('deleveredproduct')->where('date', $today)->sum('quantity');
        $todaysSold = DB::table('deleveredproduct')->where('date', $today)->sum('sellingPrice');
        $todaysSoldsNetPrice = DB::table('deleveredproduct')->where('date', $today)->sum('buyingPrice');

        $todaysProfite = $todaysSold - $todaysSoldsNetPrice;


        //Code for searching mx selling products start

        DB::table('maxPro')->delete();
        $allitem = DB::table('deleveredproduct')->get();
        foreach ($allitem as $var) {
            $brand = $var->brand;
            $modelName = $var->modelName;
            $quanatity = $var->quantity;

            $checkData = DB::table('maxPro')->where('modelName', $modelName)->first();
            if ($checkData) {
                $quantityInMaxProTable = DB::table('maxPro')->where('modelName', $modelName)->value('quantity');

                $total = $quanatity + $quantityInMaxProTable;
                DB::table('maxPro')->where('modelName', $modelName)->update([
                    'quantity' => $total
                ]);
            } else {
                DB::table('maxPro')->insert([
                    'brand' => $brand,
                    'modelName' => $modelName,
                    'quantity' => $quanatity
                ]);
            }


        }


        //Code for searching mx selling products end


        //Code for searching top buyer start

        DB::table('topclient')->delete();
        $allClient = DB::table('sellingvoucher')->where('id', '>', 129)->get();
        foreach ($allClient as $var) {
            $voucherNo = $var->voucherNo;
            $cusName = $var->customerName;


            $quantittyInAVoucher = DB::table('deleveredproduct')->where('voucherNo', $voucherNo)->sum('quantity');


            $checkData = DB::table('topclient')->where('name', $cusName)->first();
            if ($checkData) {
                $beforeQuantity = DB::table('topclient')->where('name', $cusName)->value('quantity');


                $total = $beforeQuantity + $quantittyInAVoucher;
                DB::table('topclient')->where('name', $cusName)->update([
                    'quantity' => $total
                ]);
            } else {
                DB::table('topclient')->insert([

                    'name' => $cusName,
                    'quantity' => $quantittyInAVoucher
                ]);
            }


        }


        //Code for those products which is less than 5

        $lessProducts = DB::table('storage')->where('quantity','<',5)->get();



        //Code for searching top buyer end


        //Now sending data of max pro and top client list inside dashboard

        $maxSellingProduct = DB::table('maxpro')->limit(5)->orderBy('quantity', 'desc')->get();
        $topClient = DB::table('topClient')->limit(5)->orderBy('quantity', 'desc')->get();


        //Getting only month and only this year data from  string
        $array = explode(' ', trim($today));
        $thisMonthName = $array[0];

        $fullYear = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->get();
        $fullMonth = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->Where('date', 'like', '%' . $thisMonthName . '%')->get();


        //Data fetching for yearly reports counting per montly

        $jan = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jan' . '%')->sum('sellingPrice');
        $feb = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Feb' . '%')->sum('sellingPrice');
        $mar = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Mar' . '%')->sum('sellingPrice');
        $apr = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Apr' . '%')->sum('sellingPrice');
        $may = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'May' . '%')->sum('sellingPrice');
        $jun = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jun' . '%')->sum('sellingPrice');
        $jul = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jul' . '%')->sum('sellingPrice');
        $aug = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Aug' . '%')->sum('sellingPrice');
        $sep = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Sep' . '%')->sum('sellingPrice');
        $oct = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Oct' . '%')->sum('sellingPrice');
        $nov = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Nov' . '%')->sum('sellingPrice');
        $dec = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Dec' . '%')->sum('sellingPrice');



        //Data fetching for buying

        $janBrought =  DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jan' . '%')->sum('myBill');
        $febBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Feb' . '%')->sum('myBill');
        $marBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Mar' . '%')->sum('myBill');
        $aprBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Apr' . '%')->sum('myBill');
        $mayBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'May' . '%')->sum('myBill');
        $junBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jun' . '%')->sum('myBill');
        $julBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jul' . '%')->sum('myBill');
        $augBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Aug' . '%')->sum('myBill');
        $sepBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Sep' . '%')->sum('myBill');
        $octBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Oct' . '%')->sum('myBill');
        $novBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Nov' . '%')->sum('myBill');
        $decBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Dec' . '%')->sum('myBill');


        return view('dashboard')->withToday($today)->withTodaysQuantity($todaysQuantity)->withTodaysSold($todaysSold)->withTodaysSoldNetPrice($todaysSoldsNetPrice)->withTodaysProfite($todaysProfite)->withTodaysBrought($todaysBrought)->withYear($year)->withMaxSellingProduct($maxSellingProduct)->withTopClient($topClient)->withJan($jan)->withFeb($feb)->withMar($mar)->withApr($apr)->withMay($may)->withJun($jun)->withJul($jul)->withAug($aug)->withSep($sep)->withOct($oct)->withNov($nov)->withDec($dec)

          ->withJanBrought($janBrought)->withFebBrought($febBrought)->withMarBrought($marBrought)->withAprBrought($aprBrought)->withMayBrought($mayBrought)->withJunBrought($junBrought)->withJulBrought($julBrought)->withAugBrought($augBrought)->withSepBrought($sepBrought)->withOctBrought($octBrought)->withNovBrought($novBrought)->withDecBrought($decBrought)->withLessProducts($lessProducts)  ;





    }


    public function manualSearch($year, $month, $day)
    {




        //taking time info for todays analysis part


        if ($day == "fullMonth" ) {


            $thatDayBrought = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->Where('date', 'like', '%' . $month . '%')->sum('myBill');
            $thatDaysQuantity = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->Where('date', 'like', '%' . $month . '%')->sum('quantity');
            $thatDaysSold = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->Where('date', 'like', '%' . $month . '%')->sum('sellingPrice');
            $thatDaysSoldsNetPrice = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->Where('date', 'like', '%' . $month . '%')->sum('buyingPrice');

            $thatDaysProfite = $thatDaysSold - $thatDaysSoldsNetPrice;

            echo "
        
           
    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
        <div class='info-box bg-pink hover-expand-effect'>
            <div class='icon'>
                <i class='material-icons'>playlist_add_check</i>
            </div>
            <div class='content'>
                <div class='text'>Brought </div>
                 <div class='number ' >$thatDayBrought</div>

            </div>
        </div>
    </div>
    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
        <div class='info-box bg-cyan hover-expand-effect'>
            <div class='icon'>
                <i class='material-icons'>credit_card</i>
            </div>
            <div class='content'>
                <div class='text'>Sold</div>
                <div class='number ' >$thatDaysSold</div>

            </div>
        </div>
    </div>
    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
        <div class='info-box bg-light-green hover-expand-effect'>
            <div class='icon'>
                <i class='material-icons'>money</i>
            </div>
            <div class='content'>
                <div class='text'>Profit</div>
                <div class='number ' >$thatDaysProfite</div>

            </div>
        </div>
    </div>
    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
        <div class='info-box bg-orange hover-expand-effect'>
            <div class='icon'>
                <i class='material-icons'>mobile_friendly</i>
            </div>
            <div class='content'>
                <div class='text'>Total Product</div>
                 <div class='number ' >$thatDaysQuantity</div>
            </div>
        </div>
    </div>
    
        
        ";

        } else {


            $concatingDate = "$month $day, $year";
            // echo $concatingDate;

            $thatDayBrought = DB::table('buyingvoucher')->where('date', $concatingDate)->sum('myBill');
            $thatDaysQuantity = DB::table('deleveredproduct')->where('date', $concatingDate)->sum('quantity');
            $thatDaysSold = DB::table('deleveredproduct')->where('date', $concatingDate)->sum('sellingPrice');
            $thatDaysSoldsNetPrice = DB::table('deleveredproduct')->where('date', $concatingDate)->sum('buyingPrice');

            $thatDaysProfite = $thatDaysSold - $thatDaysSoldsNetPrice;

            echo "
        
           
    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
        <div class='info-box bg-pink hover-expand-effect'>
            <div class='icon'>
                <i class='material-icons'>playlist_add_check</i>
            </div>
            <div class='content'>
                <div class='text'>Brought </div>
                 <div class='number ' >$thatDayBrought</div>

            </div>
        </div>
    </div>
    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
        <div class='info-box bg-cyan hover-expand-effect'>
            <div class='icon'>
                <i class='material-icons'>credit_card</i>
            </div>
            <div class='content'>
                <div class='text'>Sold</div>
                <div class='number ' >$thatDaysSold</div>

            </div>
        </div>
    </div>
    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
        <div class='info-box bg-light-green hover-expand-effect'>
            <div class='icon'>
                <i class='material-icons'>money</i>
            </div>
            <div class='content'>
                <div class='text'>Profit</div>
                <div class='number ' >$thatDaysProfite</div>

            </div>
        </div>
    </div>
    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
        <div class='info-box bg-orange hover-expand-effect'>
            <div class='icon'>
                <i class='material-icons'>mobile_friendly</i>
            </div>
            <div class='content'>
                <div class='text'>Total Product</div>
                 <div class='number ' >$thatDaysQuantity</div>
            </div>
        </div>
    </div>
    
        
        ";

        }


    }


    public function manualDetails($year, $month, $day)
    {


        $date = "$month (full month), $year  ";
       ;


        //taking time info for todays analysis part


        if ($day == "fullMonth" ) {

            //selling history

            $data= DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . $month . '%')->get();
            $quantityData= DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . $month . '%')->sum('quantity');
            $price= DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . $month . '%')->sum('sellingPrice');




            $bdata= DB::table('broughtproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . $month . '%')->get();

            $bquantityData= DB::table('broughtproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . $month . '%')->sum('quantity');
            $bprice= DB::table('broughtproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . $month . '%')->sum('myBill');


            return view('dailyRecords')->withData($data)->withQuantityData($quantityData)->withPrice($price)->withDate($date)->withBdata($bdata)->withBquantityData($bquantityData)->withBprice($bprice);



            //Buying history




        } else {


            $concatingDate = "$month $day, $year";
            // echo $concatingDate;

            $date = "$month $day, $year";


            $data = DB::table('deleveredproduct')->where('date', 'like', '%' . $concatingDate . '%')->get();
            $quantityData = DB::table('deleveredproduct')->where('date', 'like', '%' . $concatingDate . '%')->sum('quantity');
            $price = DB::table('deleveredproduct')->where('date', 'like', '%' . $concatingDate . '%')->sum('sellingPrice');


            $bdata = DB::table('broughtproduct')->where('date', 'like', '%' . $concatingDate . '%')->get();
            $bquantityData = DB::table('broughtproduct')->where('date', 'like', '%' . $concatingDate . '%')->sum('quantity');
            $bprice = DB::table('broughtproduct')->where('date', 'like', '%' . $concatingDate . '%')->sum('myBill');





            return view('dailyRecords')->withData($data)->withQuantityData($quantityData)->withPrice($price)->withDate($date)->withBdata($bdata)->withBquantityData($bquantityData)->withBprice($bprice);




        }


    }







    //Selling reports
    public function yearlyReports($year){


        $jan = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jan' . '%')->sum('sellingPrice');
        $feb = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Feb' . '%')->sum('sellingPrice');
        $mar = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Mar' . '%')->sum('sellingPrice');
        $apr = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Apr' . '%')->sum('sellingPrice');
        $may = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'May' . '%')->sum('sellingPrice');
        $jun = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jun' . '%')->sum('sellingPrice');
        $jul = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jul' . '%')->sum('sellingPrice');
        $aug = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Aug' . '%')->sum('sellingPrice');
        $sep = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Sep' . '%')->sum('sellingPrice');
        $oct = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Oct' . '%')->sum('sellingPrice');
        $nov = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Nov' . '%')->sum('sellingPrice');
        $dec = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Dec' . '%')->sum('sellingPrice');


         $janHeight = ($jan/2000).'px';
         $febHeight = ($feb/2000).'px';
         $marHeight = ($mar/2000).'px';
         $aprHeight = ($apr/2000).'px';
         $mayHeight = ($may/2000).'px';
         $junHeight = ($jun/2000).'px';
         $julHeight = ($jul/2000).'px';
         $augHeight = ($aug/2000).'px';
         $sepHeight = ($sep/2000).'px';
         $octHeight = ($oct/2000).'px';
         $novHeight = ($nov/2000).'px';
         $decHeight = ($dec/2000).'px';




        echo "
         <tr>
                                        <th  class=\"chartTableBars\"><div style=\"height: $janHeight ;\" class=\"chartPingBar chartGreen\"><p>$jan</p></div></th>
                                        <th  class=\"chartTableBars\"><div style=\"height: $febHeight;\" class=\"chartPingBar chartGreen\"><p>$feb</p></div></th>
                                        <th  class=\"chartTableBars\"><div style=\"height: $marHeight;\" class=\"chartPingBar chartGreen\"><p>$mar</p></div></th>
                                        <th  class=\"chartTableBars\"><div style=\"height: $aprHeight;\" class=\"chartPingBar chartGreen\"><p>$apr</p></div></th>
                                        <th  class=\"chartTableBars\"><div style=\"height: $mayHeight;\" class=\"chartPingBar chartRed\"><p>$may</p></div></th>
                                        <th  class=\"chartTableBars\"><div style=\"height: $junHeight;\" class=\"chartPingBar chartGreen\"><p>$jun</p></div></th>
                                        <th  class=\"chartTableBars\"><div style=\"height: $julHeight;\" class=\"chartPingBar chartGreen\"><p>$jul</p></div></th>
                                        <th  class=\"chartTableBars\"><div style=\"height: $augHeight;\" class=\"chartPingBar chartGreen\"><p>$aug</p></div></th>
                                        <th  class=\"chartTableBars\"><div style=\"height: $sepHeight;\" class=\"chartPingBar chartGreen\"><p>$sep</p></div></th>
                                        <th  class=\"chartTableBars\"><div style=\"height: $octHeight;\" class=\"chartPingBar chartGreen\"><p>$oct</p></div></th>
                                        <th  class=\"chartTableBars\"><div style=\"height: $novHeight;\" class=\"chartPingBar chartGreen\"><p>$nov</p></div></th>
                                        <th  class=\"chartTableBars\"><div style=\"height: $decHeight;\" class=\"chartPingBar chartGreen\"><p>$dec</p></div></th>
                                    </tr>
                                    <tr>
                                        <th class=\"chartTableBottomTimeUnits\">jan</th>
                                        <th class=\"chartTableBottomTimeUnits\">feb</th>
                                        <th class=\"chartTableBottomTimeUnits\">mar</th>
                                        <th class=\"chartTableBottomTimeUnits\">apr</th>
                                        <th class=\"chartTableBottomTimeUnits\">may</th>
                                        <th class=\"chartTableBottomTimeUnits\">jun</th>
                                        <th class=\"chartTableBottomTimeUnits\">jul</th>
                                        <th class=\"chartTableBottomTimeUnits\">aug</th>
                                        <th class=\"chartTableBottomTimeUnits\">sep</th>
                                        <th class=\"chartTableBottomTimeUnits\">oct</th>
                                        <th class=\"chartTableBottomTimeUnits\">nov</th>
                                        <th class=\"chartTableBottomTimeUnits\">dec</th>
                                    </tr>

        ";



    }


    public function monthlyBuyingReports($year){

        //Data fetching for buying

        $janBrought =  DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jan' . '%')->sum('myBill');
        $febBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Feb' . '%')->sum('myBill');
        $marBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Mar' . '%')->sum('myBill');
        $aprBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Apr' . '%')->sum('myBill');
        $mayBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'May' . '%')->sum('myBill');
        $junBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jun' . '%')->sum('myBill');
        $julBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jul' . '%')->sum('myBill');
        $augBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Aug' . '%')->sum('myBill');
        $sepBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Sep' . '%')->sum('myBill');
        $octBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Oct' . '%')->sum('myBill');
        $novBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Nov' . '%')->sum('myBill');
        $decBrought  = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Dec' . '%')->sum('myBill');



        $janHeight = ($janBrought/2000).'px';
        $febHeight = ($febBrought/2000).'px';
        $marHeight = ($marBrought/2000).'px';
        $aprHeight = ($aprBrought/2000).'px';
        $mayHeight = ($mayBrought/2000).'px';
        $junHeight = ($junBrought/2000).'px';
        $julHeight = ($julBrought/2000).'px';
        $augHeight = ($augBrought/2000).'px';
        $sepHeight = ($sepBrought/2000).'px';
        $octHeight = ($octBrought/2000).'px';
        $novHeight = ($novBrought/2000).'px';
        $decHeight = ($decBrought/2000).'px';


        echo "
        
         <tr>
                                    <th  class=\"chartTableBars\"><div  style=\"height:$janHeight;\" class=\"chartPingBar chartRed\"><p>$janBrought</p></div></th>
                                    <th  class=\"chartTableBars\"><div style=\"height: $febHeight;\" class=\"chartPingBar chartRed\"><p>$febBrought</p></div></th>
                                    <th  class=\"chartTableBars\"><div style=\"height: $marHeight ;\" class=\"chartPingBar chartRed\"><p>$marBrought</p></div></th>
                                    <th  class=\"chartTableBars\"><div style=\"height: $aprHeight;\" class=\"chartPingBar chartRed\"><p>$aprBrought</p></div></th>
                                    <th  class=\"chartTableBars\"><div style=\"height: $mayHeight;\" class=\"chartPingBar chartRed\"><p>$mayBrought</p></div></th>
                                    <th  class=\"chartTableBars\"><div style=\"height: $junHeight;\" class=\"chartPingBar chartRed\"><p>$junBrought</p></div></th>
                                    <th  class=\"chartTableBars\"><div style=\"height: $julHeight;\" class=\"chartPingBar chartRed\"><p>$julBrought</p></div></th>
                                    <th  class=\"chartTableBars\"><div style=\"height: $augHeight;\" class=\"chartPingBar chartRed\"><p>$augBrought</p></div></th>
                                    <th  class=\"chartTableBars\"><div style=\"height: $sepHeight;\" class=\"chartPingBar chartRed\"><p>$sepBrought</p></div></th>
                                    <th  class=\"chartTableBars\"><div style=\"height: $octHeight;\" class=\"chartPingBar chartRed\"><p>$octBrought</p></div></th>
                                    <th  class=\"chartTableBars\"><div style=\"height: $novHeight;\" class=\"chartPingBar chartRed\"><p>$novBrought</p></div></th>
                                    <th  class=\"chartTableBars\"><div style=\"height: $decHeight;\" class=\"chartPingBar chartRed\"><p>$decBrought</p></div></th>
                                                <tr>
                                    <th class=\"chartTableBottomTimeUnits\">jan</th>
                                    <th class=\"chartTableBottomTimeUnits\">feb</th>
                                    <th class=\"chartTableBottomTimeUnits\">mar</th>
                                    <th class=\"chartTableBottomTimeUnits\">apr</th>
                                    <th class=\"chartTableBottomTimeUnits\">may</th>
                                    <th class=\"chartTableBottomTimeUnits\">jun</th>
                                    <th class=\"chartTableBottomTimeUnits\">jul</th>
                                    <th class=\"chartTableBottomTimeUnits\">aug</th>
                                    <th class=\"chartTableBottomTimeUnits\">sep</th>
                                    <th class=\"chartTableBottomTimeUnits\">oct</th>
                                    <th class=\"chartTableBottomTimeUnits\">nov</th>
                                    <th class=\"chartTableBottomTimeUnits\">dec</th>
                                </tr>

        ";

    }






}
