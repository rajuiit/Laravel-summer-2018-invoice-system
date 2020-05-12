<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','dashboardController@dashboardPage');
Route::get('/manualSearch/{year}/{month}/{day}','dashboardController@manualSearch');
Route::get('/manualDetails/{year}/{month}/{day}','dashboardController@manualDetails');
Route::get('/yearlyReports/{year}/','dashboardController@yearlyReports');
Route::get('/monthlyBuyingReports/{year}/','dashboardController@monthlyBuyingReports');
Route::get('/reportsController/{year}','reportsController@reportsControllerPage');
Route::get('test','bankBalanceCOntroller@test');
Route::get('myCash','bankBalanceController@myCashPage');
Route::get('acName/{name}','bankBalanceController@getAcName');
Route::get('sendToBank/{bankName}/{acName}/{amount}','bankBalanceController@sendToBank');
Route::get('wthdrawFromBank/{bankName}/{acName}/{amount}','bankBalanceController@wthdrawFromBank');
Route::get('addAc/','bankController@addAcPage');
Route::post('addAcName/','bankController@addAcName');
Route::get('bankListcusInfoTracking','bankController@bankListPage');



Route::post('registerCustomer','customerController@insert');
Route::post('insertCost','customerController@insertCost');
Route::post('registerWorker','payController@registerWorker');
Route::get('registerMarketerPage','marketController@registerMarketerPage');
Route::post('registerMarketer','marketController@registerMarketer');
Route::get('workerList','payController@workerList');
Route::get('marketerList','marketController@marketerList');
Route::post('registerSeller','sellerController@insert');
Route::get('/registerSeller','sellerController@registerSeller');
Route::post('registerBrand','brandController@insert');
Route::post('registerModel','modelController@insert');
Route::get('/modelRegistrationPage','modelController@modelRegisterPage');
Route::get('sellPage','sellController@sellPage');
Route::post('addToCart','sellController@addToCart');
Route::get('cartDataFetch','sellController@cartDataFetch');
Route::get('buyingCartDataFetch','buyController@buyingCartDataFetch');
Route::get('cusInfoTracking/{name}','sellController@cusInfoTracking');
Route::get('instantCusInfoTracking/{mobileNo}','sellController@instantCusInfoTracking');
Route::get('sellerInfoTracking/{name}/{myBill}','buyController@sellerInfoTracking');
Route::get('cusInfoTrackingForReturn/{name}','returnController@cusInfoTracking');
Route::get('cusInfoTrackingAfterClickingDataSend/{name}/{voucherNo}/{payment}/{paying}/{discount}/{totalBill}','returnController@cusInfoTrackingAfterClickingDataSend');
Route::get('cusInfoTrackingAfterClickingDataSendforBrought/{name}/{voucherNo}/{bill}/{paying}/{discountsellingVoucherListsPage}','returnController@cusInfoTrackingAfterClickingDataSendforBrought');
Route::get('dueCounter/{paying}/{name}','sellController@dueCounter');
Route::get('discountCounter/{name}/{paying}/{discount}','sellController@discountCounter');
Route::get('buyingDiscountCounter/{name}/{paying}/{myBill}','buyController@discountCounter');
Route::get('discountCounterForReturn/{name}/{paying}/{discount}/{voucherNo}','returnController@discountCounter');
Route::get('discountCounterForBroughtReturn/{name}/{paying}/{voucherNo}/{myBill}','returnController@discountCounterForBroughtReturn');
Route::get('checkProfite/{discount}','sellController@checkProfite');
Route::get('checkProfiteForReturn/{discount}','returnController@checkProfite');
Route::post('buyingDeliver','buyController@deliver');
Route::post('/deliver','sellController@deliver');
Route::get('cancelDelivery','sellController@cancelDelivery');
Route::get('sellingVoucherListsPage','listsController@sellingVoucherList');
Route::get('BuyingVoucherListsPage','listsController@list');
Route::get('viewSellingVoucher/{id}','listsController@sellingProductsView');
Route::get('deleteVoucher/{id}','listsController@deleteVoucher');
Route::get('buyingVoucherDelete/{voucherNo}','listsController@buyingVoucherDelete');
Route::get('buyingVoucherFetchDataAfterDelete','listsController@buyingVoucherFetchDataAfterDelete');
Route::get('fetchDataAfterDelete/','listsController@fetchDataAfterDelete');
Route::get('/returnPage/{voucherNo}','returnController@returnpage');
Route::get('/returnBroughtProduct/{voucherNo}','returnController@returnBroughtProductPage');
Route::post('/addIntoReturn','returnController@addIntoReturn');
Route::post('/addIntoMyReturn','returnController@addIntoMyReturn');
Route::get('/returnCartDataFetch/{voucherNo}','returnController@returnCartDataFetch');
Route::get('/MyReturnCartDataFetch/{voucherNo}','returnController@MyReturnCartDataFetch');
Route::get('/fetchCartDataToReturn/{voucherNo}','returnController@fetchCartDataToReturn');
Route::post('returnBroughtsaveChanges','returnController@returnBroughtsaveChanges');
Route::post('saveChanges','returnController@saveChanges');
Route::get('/buyPage','buyController@buyPage');
Route::get('/selectBrandsAndModel/{brandName}','buyController@selectBandsAndModel');
Route::post('buying','buyController@buying');
Route::get('passingModel/{name}','buyController@takingType');
Route::get('/productList','listsController@productList');
Route::get('/deleteProduct/{modelNo}','listsController@deleteProduct');
Route::get('/fetchAfterDeleteProductList','listsController@fetchAfterDeleteProductList');
Route::get('/fetchAfterDeleteSeller','listsController@fetchAfterDeleteSeller');
Route::get('/buyerList','listsController@buyerList');
Route::get('/sellerList','listsController@sellerList');
Route::get('/deleteCustomer/{customerName}','listsController@deleteCustomer');
Route::get('/deleteSeller/{sellerName}','listsController@deleteSeller');
Route::get('/deleteCost/{id}','listsController@deleteCost');
Route::get('fetchAfterDeleteCustomer','listsController@fetchAfterDeleteCustomer');
Route::get('/storageList','listsController@storageList');
Route::get('/bankList','listsController@bankListPage');
Route::get('/deleteBank/{bank}','listsController@deleteBank');
Route::get('/deleteAc/{acName}','listsController@deleteAc');
Route::get('/sellingVoucherView/{voucherNo}','invoiceViewController@sellingInvoiceViewPage');
Route::get('/buyingVoucherView/{voucherNo}','invoiceViewController@buyingInvoiceViewPage');
Route::get('/deleteMarketer/{id}','marketController@deleteMarketer');
Route::get('/deleteWorker/{id}','payController@deleteWorker');
Route::get('/workerPayList/{id}','payController@workerPayList');



Route::post('/addToBuyingCart','buyController@addToCart');


Route::get('/addBank','bankController@bankPage');
Route::post('/registerBank','bankController@registerBank');




//Normall routing (no logic or data passing )--------------------
Route::get('customerRegistrationPage',function (){
    return view('registerCustomer');
});


Route::get('brandRegistrationPage',function (){
    return view('registerBrand');
});

Route::get('/costpage',function (){
    return view('dailyCost');
});



Route::get('/workers',function (){
    return view('workers');
});



Route::get('/payment{id}','payController@paymentProcess');
Route::get('/marketerPayment{id}','marketController@paymentProcess');



Route::get('/costLists','listsController@costList');
Route::get('/paidList','payController@paidList');
Route::post('/paid','payController@paid');
Route::post('/mPaid','marketController@paid');
Route::get('/mPaidList','marketController@paidList');








Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
