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

// candidate route
Route::post("/Candidate", "App\Http\Controllers\CandicateController@addCandidate");
Route::delete("/Candidate", "App\Http\Controllers\CandicateController@delete");
Route::put("/Candidate", "App\Http\Controllers\CandicateController@update");
Route::get("/Candidate", "App\Http\Controllers\CandicateController@getAllcandidates");
// admin routes
Route::get("/getToken", "App\Http\Controllers\ApiAuthentication@login");
Route::get("/supa", "App\Http\Controllers\superAdminController@getData");



// route for crud village_number 
Route::post("/VillageNumber", "App\Http\Controllers\VillageNumberController@addVillageNumber");
Route::put("/VillageNumber", "App\Http\Controllers\VillageNumberController@update");
Route::get("/VillageNumber", "App\Http\Controllers\VillageNumberController@index");
Route::delete("/VillageNumber", "App\Http\Controllers\VillageNumberController@delete");

// select by id  
Route::get("/VillageNumber", "App\Http\Controllers\VillageNumberController@show");


//route test crud image 
Route::post("/testcrud", "App\Http\Controllers\TestCrudController@store");
Route::put("/testcrud", "App\Http\Controllers\TestCrudController@update");

// route for test 
Route::get("test", function () {
    $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
        'grant_type' => 'password',
        'client_id' => '2',
        'client_secret' => 'E8CjKMjA3Cqyw7Qi44O5yAyR1JznILiJNgyweI57',
        'phoneNumber' => '+8562011111111',
        'password' => 'test',
        'scope' => '',
    ]);

    return $response->json();
});
