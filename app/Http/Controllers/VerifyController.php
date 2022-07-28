<?php

namespace App\Http\Controllers;

use App\Models\Verify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VerifyController extends Controller
{


    public function __construct()
        {
    
            
            $this->middleware("auth:api");
        }
    public function addVerify(Request $request){
        $request->validate([
            "user_id" => "string|required",
            "picture_verify" => "required",
           
          
        ]);
        // get fillable from Model Candidate and send request to data table 
        $Verifys = new Verify();
        $Verifys->user_id = $request->user_id;
       

        // add image from function storeCandidateImage in 
        $Verifys->picture_verify = $Verifys->storeVerifyImage($request->picture_verify);
   
        $Verifys->save();


        return response()->json(["data" => $Verifys]);
    }
    
}
