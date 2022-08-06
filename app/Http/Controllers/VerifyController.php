<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Verify;
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
        $verifies = Verify::findOrFail($id);
        $data = DB::table('verifies')
            ->where('id', $request->id)
            ->get();
        return response()->json(["data" => $data]);
    }
    public function showUserverify(Request $request, $id)
    {
        $id = $request->id;
        
$user=DB::select('SELECT users.name,users.status,users.phoneNumber,populations.gender,populations.name,populations.surname,populations.phoneNumber, verifies.picture_verify,verifies.status, populations.image
FROM users,verifies,populations 
WHERE populations.phoneNumber=users.phoneNumber AND users.id = .' .$id.'');


return response()->json(['dataUsers' => $user]);
     
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
    public function showdetail_before_verify( Request $request){



    }
}
