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
    public function getAllvillage_numbers(Request $request)
    {
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

    public function update(Request $request, $id)
    {
        $request->validate([
            "number" => "string|required",
        ]);


        $villages = VillageNumber::findOrFail($id);
        $villages['number'] = $request->number;

        $villages->save();


        return response()->json(['status' => 'update success', $villages]);
    }



    public function delete(request $request, $id)
    {
        $id = $request->id;
        $id = DB::table('village_numbers')
            ->where('id', $id)
            ->delete();
        return response()->json(['massage' => 'delete success', $id]);
    }


    function showByid(Request $request, $id)
    {
        $id = $request->id;
        $data = array();
        $data = DB::table('village_numbers')
            ->where('id', $id)
            ->get();
        if (!$id) {
            return response()->json(['massage' => 'no id request', $data]);
        } else if (!$data) {
            return response()->json(['massage' => 'no data', $data]);
        } else if ($data == null) {
            return response()->json(['massage' => 'get succesefully', $data]);
        } else {
            return response()->json(['massage' => 'no data and id', $data]);
        }
    }
    public function show(Request $request)
    {

        $data = DB::table('village_numbers')
            ->get();

        return response()->json(['massage' => 'get succesefully', $data]);
    }
}
