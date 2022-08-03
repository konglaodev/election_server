<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthentication;
use App\Models\Role;
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
Route::delete("/Candidate/{id}", "App\Http\Controllers\CandicateController@delete");
Route::put("/Candidate/{id}", "App\Http\Controllers\CandicateController@update");
Route::get("/Candidate", "App\Http\Controllers\CandicateController@getAllcandidates");
Route::get("/Candidate/{id}", "App\Http\Controllers\CandicateController@getCandidatesById");
// admin routes
Route::get("/getToken", "App\Http\Controllers\ApiAuthentication@login");
Route::get("/supa", "App\Http\Controllers\superAdminController@getData");
Route::get("/checkauth", "App\Http\Controllers\superAdminController@getData");


//user routes
Route::delete("/deleteusers/{id}", "App\http\Controllers\UserController@deleteusers");
Route::post("/register", "App\http\Controllers\UserController@register");
Route::get("/getalluser", "App\http\Controllers\UserController@getallusers");
Route::post("/userslogin", "App\http\Controllers\ApiAuthentication@userslogin");

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

Route::post("/cencus", "App\Http\Controllers\CencusController@create");
Route::put("/cencus/{id}", "App\Http\Controllers\CencusController@update");
Route::delete("/cencus/{id}", "App\Http\Controllers\CencusController@delete");
Route::get("/cencus/{id}", "App\Http\Controllers\CencusController@selectById");
Route::get("/cencus", "App\Http\Controllers\CencusController@index");

//populations

Route::post("/populations", "App\Http\Controllers\PopulationController@create");
Route::put("/populations/{id}", "App\Http\Controllers\PopulationController@update");
Route::delete("/populations/{id}", "App\Http\Controllers\PopulationController@delete");

Route::get("/populations", "App\Http\Controllers\PopulationController@index");
Route::get("/populations/{id}", "App\Http\Controllers\PopulationController@getPulationsById");




//route vote for
Route::post("/vote", "App\Http\Controllers\VoteController@create");
Route::get("/getScore", "App\Http\Controllers\VoteController@getScore");
Route::get("/getScoreAll", "App\Http\Controllers\VoteController@getScoreAll");
// Route::post("/vote", "App\Http\Controllers\VoteController@update");
// Route::post("/vote", "App\Http\Controllers\VoteController@");

Route::post("/addVerify", "App\Http\Controllers\VerifyController@addVerify");

//route test crud image can
Route::post("/testcrud", "App\Http\Controllers\TestCrudController@store");
Route::put("/testcrud", "App\Http\Controllers\TestCrudController@update");

// route for test 
Route::get("test", function () {
    $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
        'grant_type' => 'password',
        'client_id' => '2',
        'client_secret' => 'iUGqjNrDcGHgN02NvAEVcEdEbLzLRrWtB4mpZL1F',
        'phoneNumber' => '+8562022222222',
        'password' => '1234',
        'scope' => '',
    ]);

    return $response->json(['massage'=>'getsusccess']);
});
