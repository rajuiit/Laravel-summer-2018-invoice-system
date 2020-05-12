<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class modelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   public function  modelRegisterPage(){

       //fetching brand name to pass data on model register page
       $allBrand = DB::table('brand')->get();
       return view('registerModel')->withAllBrand($allBrand);


   }

   public function  insert(Request $request){

       $brandName = $request->input('brand-name');
       $modelName = $request->input('model-name');
       $modelName = strtolower($modelName);
       $modelType = $request->input('type');
       $buyingPrice = $request->input('buying-price');
       $sellingPrice = $request->input('selling-price');

       $checkData = DB::table('model')->where('modelName',$modelName)->first();

       if($checkData){
           echo "0";
       }else{

           DB::table('model')->insert([
               'brand' => $brandName,
               'modelName' => $modelName,
               'type' => $modelType,
               'buyingPrice' => $buyingPrice,
               'sellingPrice' => $sellingPrice,
           ]);


           echo '1';
       }

   }

}
