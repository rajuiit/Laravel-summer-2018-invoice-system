<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;



class reportsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    public  function reportsControllerPage($year){

        $searchingYear = $year;

        //January month

        $jan = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jan' . '%')->value('date');

        $janSold = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jan' . '%')->sum('sellingPrice');
        $janBrought = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jan' . '%')->sum('myBill');
        $janPBuyingPrice = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jan' . '%')->sum('buyingPrice');

        $janMCost = DB::table('paid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jan' . '%')->sum('sallary');
        $janOCost = DB::table('mpaid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jan' . '%')->sum('sallary');
        $janDCost = DB::table('dailycost')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jan' . '%')->sum('cost');

        $totalCost = $janOCost+$janDCost+$janMCost;

        $janProf = $janSold - ($janPBuyingPrice+$totalCost);




        //February month
        $feb = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Feb' . '%')->value('date');

        $febSold = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Feb' . '%')->sum('sellingPrice');
        $febBrought = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Feb' . '%')->sum('myBill');
        $febPBuyingPrice = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Feb' . '%')->sum('buyingPrice');

        $febMCost = DB::table('paid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Feb' . '%')->sum('sallary');
        $febOCost = DB::table('mpaid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Feb' . '%')->sum('sallary');
        $febDCost = DB::table('dailycost')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Feb' . '%')->sum('cost');

        $totalCostFeb = $febOCost+$febDCost+$febMCost;

        $febProf = $febSold - ($febPBuyingPrice+$totalCostFeb);


        //March month
        $mar = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Mar' . '%')->value('date');
        $marchSold = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Mar' . '%')->sum('sellingPrice');
        $marchBrought = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Mar' . '%')->sum('myBill');
        $marchBuyingPrice = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Mar' . '%')->sum('buyingPrice');

        $marchMCost = DB::table('paid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Mar' . '%')->sum('sallary');
        $marchOCost = DB::table('mpaid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Mar' . '%')->sum('sallary');
        $marchDCost = DB::table('dailycost')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Mar' . '%')->sum('cost');

        $totalCostMarch = $marchMCost+$marchOCost+$marchDCost;

        $marchProf = $marchSold - ($marchBuyingPrice+$totalCostMarch);


        //April month
        $apr = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Apr' . '%')->value('date');

        $aprSold = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Apr' . '%')->sum('sellingPrice');
        $aprBrought = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Apr' . '%')->sum('myBill');
        $aprBuyingPrice = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Apr' . '%')->sum('buyingPrice');

        $aprMCost = DB::table('paid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Apr' . '%')->sum('sallary');
        $aprOCost = DB::table('mpaid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Apr' . '%')->sum('sallary');
        $aprDCost = DB::table('dailycost')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Apr' . '%')->sum('cost');

        $totalCostApr = $aprMCost+$aprOCost+$aprDCost;

        $aprProf = $aprSold - ($aprBuyingPrice+$totalCostApr);

        //May month----------

        $may = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'May' . '%')->value('date');

        $maySold = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'May' . '%')->sum('sellingPrice');
        $mayBrought = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'May' . '%')->sum('myBill');
        $mayBuyingPrice = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'May' . '%')->sum('buyingPrice');

        $mayMCost = DB::table('paid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'May' . '%')->sum('sallary');
        $mayOCost = DB::table('mpaid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'May' . '%')->sum('sallary');
        $mayDCost = DB::table('dailycost')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'May' . '%')->sum('cost');

        $totalCostMay = $mayMCost+$mayOCost+$mayDCost;

        $mayProf = $maySold - ($mayBuyingPrice+$totalCostMay);


        //Jun month --------
        $jun = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jun' . '%')->value('date');

        $junSold = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jun' . '%')->sum('sellingPrice');
        $junBrought = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jun' . '%')->sum('myBill');
        $junBuyingPrice = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jun' . '%')->sum('buyingPrice');

        $junMCost = DB::table('paid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jun' . '%')->sum('sallary');
        $junOCost = DB::table('mpaid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jun' . '%')->sum('sallary');
        $junDCost = DB::table('dailycost')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jun' . '%')->sum('cost');

        $totalCostJun = $junMCost+$junOCost+$junDCost;

        $junProf = $junSold - ($junBuyingPrice+$totalCostJun);


        //July month ---
        $jul = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jul' . '%')->value('date');
        $julSold = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jul' . '%')->sum('sellingPrice');
        $julBrought = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jul' . '%')->sum('myBill');
        $julBuyingPrice = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jul' . '%')->sum('buyingPrice');

        $julMCost = DB::table('paid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jun' . '%')->sum('sallary');
        $julOCost = DB::table('mpaid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jun' . '%')->sum('sallary');
        $julDCost = DB::table('dailycost')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Jun' . '%')->sum('cost');

        $totalCostJul = $julMCost+$julOCost+$julDCost;

        $julProf = $julSold - ($julBuyingPrice+$totalCostJul);

        //August month ----

        $aug = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Aug' . '%')->value('date');

        $augSold = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Aug' . '%')->sum('sellingPrice');
        $augBrought = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Aug' . '%')->sum('myBill');
        $augBuyingPrice = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Aug' . '%')->sum('buyingPrice');

        $augMCost = DB::table('paid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Aug' . '%')->sum('sallary');
        $augOCost = DB::table('mpaid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Aug' . '%')->sum('sallary');
        $augDCost = DB::table('dailycost')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Aug' . '%')->sum('cost');

        $totalCostAug = $augMCost+$augOCost+$augDCost;

        $augProf = $augSold - ($augBuyingPrice+$totalCostAug);


        //September month----
        $sep = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Sep' . '%')->value('date');

        $sepSold = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Sep' . '%')->sum('sellingPrice');
        $sepBrought = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Sep' . '%')->sum('myBill');
        $sepBuyingPrice = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Sep' . '%')->sum('buyingPrice');

        $sepMCost = DB::table('paid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Sep' . '%')->sum('sallary');
        $sepOCost = DB::table('mpaid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Sep' . '%')->sum('sallary');
        $sepDCost = DB::table('dailycost')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Sep' . '%')->sum('cost');

        $totalCostSep = $sepMCost+$sepOCost+$sepDCost;

        $sepProf = $sepSold - ($sepBuyingPrice+$totalCostSep);

        // October month
        $oct = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Oct' . '%')->value('date');

        $octSold = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Oct' . '%')->sum('sellingPrice');
        $octBrought = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Oct' . '%')->sum('myBill');
        $octBuyingPrice = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Oct' . '%')->sum('buyingPrice');

        $octMCost = DB::table('paid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Oct' . '%')->sum('sallary');
        $octOCost = DB::table('mpaid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Oct' . '%')->sum('sallary');
        $octDCost = DB::table('dailycost')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Oct' . '%')->sum('cost');

        $totalCostOct = $octMCost+$octOCost+$octDCost;

        $octProf = $octSold - ($octBuyingPrice+$totalCostOct);

        //November month--
        $nov = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Nov' . '%')->value('date');

        $novSold = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Nov' . '%')->sum('sellingPrice');
        $novBrought = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Nov' . '%')->sum('myBill');
        $novBuyingPrice = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Nov' . '%')->sum('buyingPrice');

        $novMCost = DB::table('paid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Nov' . '%')->sum('sallary');
        $novOCost = DB::table('mpaid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Nov' . '%')->sum('sallary');
        $novDCost = DB::table('dailycost')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Nov' . '%')->sum('cost');

        $totalCostNov = $novMCost+$novOCost+$novDCost;

        $novProf = $novSold - ($novBuyingPrice+$totalCostNov);


        //December month
        $dec = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Dec' . '%')->value('date');

        $decSold = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Dec' . '%')->sum('sellingPrice');
        $decBrought = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Dec' . '%')->sum('myBill');
        $decBuyingPrice = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Dec' . '%')->sum('buyingPrice');

        $decMCost = DB::table('paid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Dec' . '%')->sum('sallary');
        $decOCost = DB::table('mpaid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Dec' . '%')->sum('sallary');
        $decDCost = DB::table('dailycost')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . 'Dec' . '%')->sum('cost');

        $totalCostDec = $decMCost+$decOCost+$decDCost;

        $decProf = $decSold - ($decBuyingPrice+$totalCostDec);





        $timeDateVar = new Carbon();
        $today = $timeDateVar->toFormattedDateString();
        $currentYear = $timeDateVar->year;


        //Full year income brought and profite
        $yearSold = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->sum('sellingPrice');
        $yearBrought = DB::table('buyingvoucher')->where('date', 'like', '%' . $year . '%')->sum('myBill');
        $yearBuyingPrice = DB::table('deleveredproduct')->where('date', 'like', '%' . $year . '%')->sum('buyingPrice');
        $yearProf = $yearSold- $yearBuyingPrice;

        $yearlyCost = $totalCost+ $totalCostFeb+$totalCostMarch+ $totalCostApr+$totalCostMay+$totalCostJun+ $totalCostJul + $totalCostAug+$totalCostSep+$totalCostOct+$totalCostNov+$totalCostDec;
        $yearProf = $janProf+$febProf+$marchProf+$aprProf+$mayProf+$julProf+$junProf+$augProf+$sepProf+$octProf+$novProf+$decProf;


        return view('reports')->withYear($year)->withJan($jan)->withFeb($feb)->withMar($mar)->withApr($apr)->withMay($may)->withJun($jun)->withJul($jul)->withAug($aug)->withSep($sep)->withOct($oct)->withNov($nov)->withDec($dec)->
            withTotalCost($totalCost)->withTotalCostFeb($totalCostFeb)->withTotalCostMarch($totalCostMarch)->withTotalCostApr($totalCostApr)->withTotalCostMay($totalCostMay)->withTotalCostJun($totalCostJun)->withTotalCostJul($totalCostJul)->withTotalCostAug($totalCostAug)->withTotalCostSep($totalCostSep)->withTotalCostOct($totalCostOct)->withTotalCostNov($totalCostNov)->withTotalCostDec($totalCostDec)->withJanBrought($janBrought)->withJanSold($janSold)->withJanProf($janProf)->withFebBrought($febBrought)->withFebSold($febSold)->withFebProf($febProf)->withMarchBrought($marchBrought)->withMarchSold($marchSold)->withMarchProf($marchProf)
            ->withAprBrought($aprBrought)->withAprSold($aprSold)->withAprProf($aprProf)->withMayBrought($mayBrought)->
            withMaySold($maySold)->withMayProf($mayProf)->withJunBrought($junBrought)->withJunSold($julSold)->withJunProf($junProf)->
            withJulBrought($junBrought)->withJulSold($julSold)->withJulProf($julProf)->withAugBrought($augBrought)->withAugSold($augSold)->
            withAugProf($augProf)->withSepBrought($sepBrought)->withSepSold($sepSold)->withSepProf($sepProf)->
            withOctBrought($octBrought)->withOctSold($octSold)->withOctProf($octProf)->withNovBrought($novBrought)->
            withNovSold($novSold)->withNovProf($novProf)->withDecBrought($decBrought)->withDecSold($decSold)->withDecProf($decProf)->withYearSold($yearSold)->withYearBrought($yearBrought)->withYearProf($yearProf)
            ->withCurrentYear($currentYear)->withYearlyCost($yearlyCost);

    }


}
