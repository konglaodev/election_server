<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Population;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Mockery\Generator\StringManipulation\Pass\Pass;

class ApiAuthentication extends Controller
{
    public function login(){
$response = Http::asForm()->post('http://localhost:8001/oauth/token', [
    'grant_type' => 'password',
    'client_id' => '2',
    'client_secret' => 'QqutVEPuxNtp0jopj54Vl37m45CsZdkZw4P5PkSO',
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
        $users->password =bcrypt($request->password);
        $users->status =  $status;
        $users->role_id =3;
        $users->save();

        return response()->json(["data"=>$users]);

    }
    //login function
    public function userslogin(Request $request){
            
        $username = '+85620'. $request->username;
        $psw=$request->password;
        $users= User::where('phoneNumber',$username)->first();
        $populations= Population::where('phoneNumber',$username)->first();
        $response = Http::asForm()->post('http://localhost:8001/oauth/token', [
            'grant_type' => 'password',
            'client_id' => '2',
            'client_secret' => 'uGnpxV3YcMrhQgw8UCkon0VmuTATqmwSrlQ2t5pm',
            'username' => $username,
            'password' => $psw,
            'scope' => '',
        ]);
        
         
        return response()->json(['Token'=>$response->json(),'Users'=>$users,'Population'=>$populations]);
    }
        //edit users
            
            public function edit_user_role(Request $request,$id){
                $request->validate([
                    "role_id"=>"required",
                ]);

                $user = User::findOrFail($id); 
                $user['role_id']=$request->role_id;
                $user->save();
                return response()->json(["role_id" => $user]);
              

            }
            //add user wih role 
            public function adduser(Request $request){
                $request->validate([
                   
                    "name"=>"string|required",
                    "phoneNumber"=>"integer|required",
                    "password"=>"string|required",
                    "role_id"=>"integer|required",
                ]);

                $user = new User();
                $user['name']=$request->name;
                $user['phoneNumber']='+85620'.$request->phoneNumber;
                $user['password']=bcrypt($request->password);
                $user['role_id']= $request->role_id;
                $user->save();
                return response()->json(["data" => $user]);
            }
        
    
}
