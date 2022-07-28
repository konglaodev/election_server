<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Population;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class ApiAuthentication extends Controller
{
    public function login(){
$response = Http::asForm()->post('http://localhost:8001/oauth/token', [
    'grant_type' => 'password',
    'client_id' => '2',
    'client_secret' => 'iUGqjNrDcGHgN02NvAEVcEdEbLzLRrWtB4mpZL1F',
    'username' => '+8562022222222',
    'password' => '1234',
    'scope' => '',
]);
 
return $response->json();
    }


    public function register( Request $request) {
        $request->validate([
            "name"=>"string|required",
            "phoneNumber"=>"string|required",
            "password"=>"string|required",
            "status"=>"string|required",
            
          
          
        ]);
        $status = "not_verify"; 
        $population = Population::where("phoneNumber",$request->phoneNumber)->first();
        if($population){
            $status="verify";
        }
        $users = new User();
        $users->name = $request->name;
        $users->phoneNumber = $request->phoneNumber;
        $users->password = $request->password;
        $users->status =  $status;
        $users->role_id =3;
        $users->save();

        return response()->json(["data"=>$users]);

    }
}
