<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Population;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api');
    }
  
    public function register(Request $request)
    {

        

        $request->validate([

            "name" => "string|required",
            "username" => "string|required",
            "password" => "string|required",


        ]);
        $status = "not_verify";
        $phone = User::where('phoneNumber', '=', $request->username)->first();


        $population = Population::where("phoneNumber", $request->username)->first();
        if ($phone) {
            return response()->json(["massage" => 'phone number is registered']);
        } else if (!$phone) {
            if ($population) {
                $status = "verify";
                
                
            }
            $users = new User();
                $users->name = $request->name;
                $users->phoneNumber = "+856"+ $request->username;
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
}
