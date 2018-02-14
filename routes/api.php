<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/cards/validate', 'CardController@validateCard');
Route::post('/cards/token', 'CardController@generateToken');

Route::post('/buyers','BuyerController@create');


Route::post('/payments/creditcard', 'PaymentController@paymentWithCreditCard');
Route::post('/payments/boleto', 'PaymentController@paymentWithBoleto');
Route::get('/payments/status', 'PaymentController@statusPayment');