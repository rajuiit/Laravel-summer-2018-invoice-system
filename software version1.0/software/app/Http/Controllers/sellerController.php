<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class sellerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function registerSeller(){
        return view('registerSeller');
    }



        public function insert(Request $request){



            $sellerName = $request->input('seller-name');
            $sellerName = strtolower($sellerName);
            $sellerAddress = $request->input('seller-address');

           $checkData =  DB ::table('seller')->where('name',$sellerName)->first();

           if($checkData){
               echo "0";
           }else{

               DB::table('seller')->insert([
                   'name' => $sellerName,
                   'address' => $sellerAddress,
                   'get'    =>0
               ]);

               echo '1';
           }


        }


}
