<?php

namespace App\Http\Controllers;

use App\Models\VillageNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VillageNumberController extends Controller
{
    public function __construct()
    {
        // $this->middleware("isAdmin:api");
    }

    //show data all 
    public function getAllvillage_numbers(Request $request)
    {
        $data = DB::table('village_numbers')
            ->get();
        return response()->json(['massage' => 'get succesefully','data' => $data]);
    }



    public function addVillageNumber(Request $request)
    {
        $request->validate([

            "number" => "string|required",

        ]);

        $villages = new VillageNumber();
        $villages->number = $request->number;
        $villages->save();

        return response()->json(['data' => $villages]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "number" => "string|required",
        ]);

    
        $villages = VillageNumber::findOrFail($id);
        $villages['number'] = $request->number;

        $villages->save();


        return response()->json(['status' => 'update success', 'data'=>$villages]);
    }



    public function delete(request $request, $id)
    {
        $id = $request->id;
        $data = DB::table('village_numbers')
            ->where('id', $id)
            ->delete();
        return response()->json(['massage' => 'delete success', 'data'=>$data]);
    }


    
    function showByid(Request $request, $id)
    {
        $id = $request->id;
        $data =DB::table('village_numbers')
        ->where('id', $id)
        ->get();
        return response()->json(['massage' => 'get villageNumber ByID', $data]);
        
    }
    public function show(Request $request)
    {

        $data = DB::table('village_numbers')
            ->get();
            if(count($data) > 0){

                return response()->json(['massage' => 'get succesefully', $data]);
                
            }else{
                return response()->json(['massage' => 'no response data',$data]);
            }

       
    }
}
