<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthentication;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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


Route::post("/addCandidate","App\Http\Controllers\CandicateController@addCandidate");

Route::get("/getToken","App\Http\Controllers\ApiAuthentication@login");
Route::get("/supa","App\Http\Controllers\superAdminController@getData");
Route::get("test",function (){
    $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
        'grant_type' => 'password',
        'client_id' => '2',
        'client_secret' => 'QWupRDfKt2gG2Szpu7qzcOac3meRqTZlnQuoa62n',
        'phoneNumber' => '+8562011111111',
        'password' => 'test',
        'scope' => '',
    ]);
     
    return $response->json();
});