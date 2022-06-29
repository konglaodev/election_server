<?php

namespace App\Http\Controllers;

use App\Models\VillageNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VillageNumberController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware("isAdmin:api");
    // }
    public function index(Request $request)
    {

        $data = array();
        $data = DB::table('village_numbers')
            ->get();
        return response()->json(['massage' => 'get succesefully', $data]);
    }
    public function addVillageNumber(Request $request)
    {
        $request->validate([
            "number" => "string|required",


        ]);

        $villages = new VillageNumber();
        $villages->number = $request->number;
        $villages->save();

        return response()->json(["data" => $villages]);
    }

    public function update(Request $request)
    {
        //    call function and request using update(Request $request)
        //     using manually not using models
        $request->validate([
            "id" => "required",
            "number" => "string|required",


        ]);
        
        $data = array();
        $id = $request->id;
        $data['number'] = $request->number;
        $data_update = DB::table('village_numbers')
            ->where('id', $id)
            ->update($data);
if($data_update==false){
    return response()->json(['status' => 'no update' ]);
}else{
    return response()->json(['status' => 'success', $data,$id]);
}
        
    }
    public function delete(request $request)
    {
        $id = $request->id;
        $id = DB::table('village_numbers')
            ->where('id', $id)
            ->delete();
        return response()->json(['massage' => 'delete success', $id]);
    }


    function show(Request $request){
        $id =$request->id;
        $data = array();
        $data = DB::table('village_numbers')
        ->where('id', $id)
            ->get();
            if($data.count($data)<1){
                return response()->json(['massage' => 'no id request', $data]);
            }else{
                return response()->json(['massage' => 'get succesefully', $data]);
            }
        
    }
}
