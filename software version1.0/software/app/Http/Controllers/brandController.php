<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class brandController extends Controller
{   //for viewing all data


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function view(){

    }


    //for viewing inserting data
    public function insert(Request $request){

        $brandName = $request->input('brand-name');
        $brandName = strtolower($brandName);


        $checkData = DB::table('brand')->where('brandName',$brandName)->first();

        if($checkData){
            echo "0";
        }else{
            DB::table('brand')->insert([
                'brandName' => $brandName,
            ]);

            echo '1';

        }



    }
}
