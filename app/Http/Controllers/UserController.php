<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function register( Request $request){

        $request->validate([

            "name" => "string|required",
            "phoneNumber" => "string|required",
            "password" => "string|required",


        ]);

        $phone = User::where('phoneNumber', '=', $request->phoneNumber)->first();
        if($phone){
          return response()->json(["massage" => 'phone number is registered']);
} else if(!$phone){
    $users = new User();
    $users->name =$request->name;
    $users->phoneNumber= $request->phoneNumber;
    $users->password = bcrypt($request->password) ;
    $users->role_id=3;
    $users->save();

    return response()->json(["data" => $users]);
    return response()->$request->all();
}
     
    }

    public function getallusers(Request $request) {
        $data = DB::table('users')
            ->get();
        return response()->json(['massage' => 'get succesefully', $data]);
    }
}
