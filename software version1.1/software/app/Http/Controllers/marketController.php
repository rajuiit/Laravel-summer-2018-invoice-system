<?php



namespace App\Http\Controllers;

use function foo\func;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class marketController extends Controller
{
    //for viewing inserting data


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function  registerMarketerPage(){
        return view('marketer');
    }
    public function registerMarketer(Request $request){

        $name = $request->input('name');
        $contact = $request->input('contact');
        $sallary = $request->input('sallary');

        //IF any data inside cart then delete it
        $timeDateVar = new Carbon();
        //  $timeDateVar = Carbon::now(new DateTimeZone('Asia/Bangladesh'));

        //  $timeZone =  $tz->toRegionTimeZone();
        $showingDate= $timeDateVar->toFormattedDateString();

        $mainDate = $timeDateVar->today();
        $year = $timeDateVar->year();


        DB::table('marketer')->insert([
            'name' => $name,
            'contact' => $contact,
            'sallary'    => $sallary


        ]);







    }


    public function marketerList(){
        $timeDateVar = new Carbon();
        $today = $timeDateVar->toFormattedDateString();
        $year = $timeDateVar->year;

        $array = explode(' ', trim($today));
        $thisMonthName = $array[0];
        //Check paid or not paid
//        $check = DB::table('paid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . $thisMonthName . '%')->value('totalSalary');
//        $janSold = DB::table('paid')->where('date', 'like', '%' . $year . '%')->where('date', 'like', '%' . $thisMonthName . '%')->sum('sallary');



        $marketer= DB::table('marketer')->get();
        return view('marketerList')->withMarketer($marketer);




    }

    public function deleteCost($id){
        //First deleting voucher
        DB::table('dailycost')->where('id',$id)->delete();
        echo "1";


    }


    public function paymentProcess($id){
        //IF any data inside cart then delete it
        $timeDateVar = new Carbon();
        //  $timeDateVar = Carbon::now(new DateTimeZone('Asia/Bangladesh'));

        //  $timeZone =  $tz->toRegionTimeZone();
        $showingDate= $timeDateVar->toFormattedDateString();

        $mainDate = $timeDateVar->today();
        ;
        $year = $timeDateVar->year;


        $info= DB::table('marketer')->where('id',$id)->first();


        return view('marketerPayment')->withInfo($info)->withYear($year);
    }


    //for viewing inserting data
    public function paid(Request $request)
    {




        //IF any data inside cart then delete it
        $timeDateVar = new Carbon();
        //  $timeDateVar = Carbon::now(new DateTimeZone('Asia/Bangladesh'));

        //  $timeZone =  $tz->toRegionTimeZone();
        $showingDate = $timeDateVar->toFormattedDateString();

        $mainDate = $timeDateVar->today();


        //...........................
        $timeDateVar = new Carbon();
        $today = $timeDateVar->toFormattedDateString();
        $year = $timeDateVar->year;

        //Getting only month and only this year data from  string
        $array = explode(' ', trim($today));
        $thisMonthName = $array[0];
        $thiYearName = $array[2];



        $name = $request->input('name');
        $totalSallary = $request->input('totalSallary');
        $sallary = $request->input('sallary');
        $type = $request->input('type');
        $process = $request->input('process');
        $cell = $request->input('cell');
        $month = $request->input('month');
        $year = $request->input('year');


        $check = DB::table('mpaid')->where('contact', $cell)->where('month',$month)->where('year',$year)->count();



        if($check>0){

            DB::table('mpaid')->where('contact', $cell)->where('month',$month)->where('year',$year)->update([
                'name' => $name,
                'totalsalary' => $totalSallary,
                'type' =>$type,
                'sallary'=> $sallary,
                'date' => $showingDate,
                'process' => $process

            ]);



        }else{

            if($type == 'pass'){

                $exSallary = $totalSallary+200;

                DB::table('mpaid')->insert([
                    'name' => $name,
                    'totalsalary' => $exSallary,
                    'type' =>$type,
                    'sallary'=> $sallary,
                    'process' => $process,
                    'status' => 0,
                    'contact' => $cell,
                    'month' => $month,
                    'year' => $year,
                    'date'=> $showingDate



                ]);

            }else{

                DB::table('mpaid')->insert([
                    'name' => $name,
                    'totalsalary' => $totalSallary,
                    'type' =>$type,
                    'sallary'=> $sallary,
                    'process' => $process,
                    'status' => 0,
                    'contact' => $cell,
                    'month' => $month,
                    'year' => $year,
                    'date'=> $showingDate



                ]);

            }

        }


    }

    public function paidList(){


        $paid= DB::table('mpaid')->get();
        return view('mPaidList')->withPaid($paid);

    }

    public function deleteMarketer($id){
        //First deleting voucher
        DB::table('marketer')->where('id',$id)->delete();
        echo "1";


    }






}
