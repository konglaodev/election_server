<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class superAdminController extends Controller
{
    public function __construct(){
        $this->middleware('isSuperAdmin:api');
    }
    public function getData(){
        return response()->json([
            "data"=>"This is super admin data"
        ]);
    }



    public function addNewUser(Request $request){
        $user = User::create([
            "name"=>"",
            "PhoneNumber"=>"",
            //"password"=>"",
            "user_id"=>"",

        ]);
    }

    public function editUser(){

    }
    public function deleteUser(){

    }
    public function getAllUser(){

    }

    public function getOneUser(){

    }
}
