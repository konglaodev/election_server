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
Route::put("/Candidate/{id}", "App\Http\Controllers\CandicateController@update");
Route::get("/Candidate", "App\Http\Controllers\CandicateController@getAllcandidates");
Route::get("/Candidate/{id}", "App\Http\Controllers\CandicateController@getCandidatesById");
// admin routes
Route::get("/getToken", "App\Http\Controllers\ApiAuthentication@login");
Route::get("/supa", "App\Http\Controllers\superAdminController@getData");



// route for crud village_number 
Route::post("/VillageNumber", "App\Http\Controllers\VillageNumberController@addVillageNumber");

Route::put("/VillageNumber/{id}", "App\Http\Controllers\VillageNumberController@update");
Route::delete("/VillageNumber/{id}", "App\Http\Controllers\VillageNumberController@delete");
//getall 
Route::get("/VillageNumber/", "App\Http\Controllers\VillageNumberController@show");
//get by id 
Route::get("/VillageNumber/{id}", "App\Http\Controllers\VillageNumberController@showByid");

// select by id  
//census route

Route::post("/census", "App\Http\Controllers\CencusController@create");
Route::put("/census/{id}", "App\Http\Controllers\CencusController@update");
Route::delete("/census/{id}", "App\Http\Controllers\CencusController@delete");
Route::get("/census/{id}", "App\Http\Controllers\CencusController@selectById");
Route::get("/census", "App\Http\Controllers\CencusController@index");

Route::post("/populations", "App\Http\Controllers\PopulationController@addPopulation");
Route::put("/populations/{id}", "App\Http\Controllers\PopulationController@update");
Route::delete("/populations/{id}", "App\Http\Controllers\PopulationController@delete");
Route::get("/populations/{id}", "App\Http\ControllersPopulationControllerr@selectById");
Route::get("/populations", "App\Http\Controllers\PopulationController@index");

//route test crud image can
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
