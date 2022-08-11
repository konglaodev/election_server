<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Population;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    // public function __construct(){
    //     $this->middleware('auth:api');
    // }
  
    public function register(Request $request)
    {

        $request->validate([

            "name" => "string|required",
            "username" => "string|required",
            "password" => "string|required",


        ]);
        
        $status = "verify";
        $phone = User::where('phoneNumber', '=', $request->username)->first();


        $population = Population::where("phoneNumber", $request->username)->first();
        if ($phone) {
            return response()->json(["massage" => 'phone number is registered'],400);
        } else if (!$phone) {

            if ($population) {
                
                $status = "not_verify";
                
            }
            $users = new User();
                $users->name = $request->name;
                $users->phoneNumber = "+85620". $request->username;
                $users->password = bcrypt($request->password);
                $users->status = $status;
                $users->role_id = 3;
                $users->save();

                return response()->json(["data" => $users]);
        }
    }

    public function getallusers(Request $request)
    {

        $data = DB::table('users')
            ->get();
        return response()->json(['data' => $data]);
    }
    public function deleteusers(Request $request, $id)
    {

        $id = $request->id;
        $data = DB::table('users')
            ->where('id', $id)
            ->delete();
        return response()->json(['massage' => 'delete success', $data]);
    }
    public function getuserid(Request $request,$id){
        $users = User::findOrFail($id);
        $data =DB::table('users')
        ->where('id', $request->id)
        ->get();
        if(!$users){
            return response()->json(['data'=> 'ບໍ່ມີຂໍ້ມູນ']);
            
          
        }
        return response()->json(['data'=> $data]);
       
       
    }
    public function getuserdeatail(Request $request,$id){
        $users = User::findOrFail($id);
        $data =DB::table('users')
        ->where('id', $request->id)
        ->get();
        if(!$users){
            return response()->json(['data'=> 'ບໍ່ມີຂໍ້ມູນ']);
            
          
        }
        return response()->json(['data'=> $data]);
       
       
    }
}
