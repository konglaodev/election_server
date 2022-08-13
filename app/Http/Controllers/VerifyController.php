<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Verify;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VerifyController extends Controller
{


    public function __construct()
    {

        // $this->middleware("auth:api");
    }
    public function addVerify(Request $request)
    {
        $request->validate([
            "user_id" => "string|required",
            "picture_verify" => "required",
        ]);
        // get fillable from Model verifies and send request to data table 
        $Verifys = new Verify();
        $Verifys->user_id = $request->user_id;
        // add image from function storeverifiesImage in 
        $Verifys->picture_verify = $Verifys->storeVerifyImage($request->picture_verify);

        $Verifys->save();


        return response()->json(["data" => $Verifys]);
    }
    public function CheckVerify(Request $request, $id)
    {
        $verifies = Verify::findOrFail($id);
        $verifies['status'] = $request->status;
        $verifies->save();
        // $data_update = DB::table('verifiess')
        //     ->where('id', $id)
        //     ->update($verifies);
        return response()->json(['status' => 'verifies successfully updated', $verifies]);
    }
    public function showverify(Request $request, $id)
    {
        //$verifies = Verify::findOrFail($id);
        
        $data = DB::table('verifies')
            ->where('user_id', $request->id)
            ->orderBy("id","desc")
            ->first();
        return response()->json(["data" => $data]);
    }
//     public function showUserverify(Request $request, $id)
//     {
//         $id = $request->id;
        
// $user= DB::select('SELECT users.name, users.phoneNumber,users.status, verifies.picture_verify FROM verifies,users WHERE verifies.user_id = users.id AND verifies.id=.' .$id.';');


// return response()->json(['dataUsers' => $user]);
     
//     }
    public function showUserverify(Request $request,$id){
        $users = DB::select('SELECT users.name, users.phoneNumber,users.status, verifies.picture_verify FROM verifies,users WHERE verifies.user_id = users.id AND verifies.id='.$id);

        return response()->json(['data'=>$users]);
   
}

    public function verifyUser(Request $request, $id)
    {
        $request->validate([
            "status" => "string|required",
        ]);

        $verifies = Verify::findOrFail($id);
        $verifies['status'] = $request->status;
        $verifies->save();
        return response()->json(['status' => 'update success', $verifies]);
    }
    public function getall()
    {

    }
    public function showall( ){
        $verify= DB::select('SELECT users.id,users.name , users.phoneNumber,users.status,verifies.picture_verify,users.status,verifies.created_at FROM verifies,users WHERE verifies.user_id = users.id;');
 
        return response()->json(['data'=>$verify]);

    }

    public function update(Request $request, $id){
        $request->validate([
            "status"=>"string|required",
          

        ]);
            

            $user = User::findOrFail($id);
            $user['status']= $request->status;
            $user->save();
            
          
        
            return response()->json(['status'=>'verify']);
    }
}
