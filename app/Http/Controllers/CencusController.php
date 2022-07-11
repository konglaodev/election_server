<?php

namespace App\Http\Controllers;
use App\Models\Cencus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CencusController extends Controller
{
    public function __construct()
    {

        // check role 
        // $this->middleware("isAdmin:api");
    }
    public function index(Request $request){
        $data = DB::table('cencuses')
        ->get();
    return response()->json(['massage' => 'get data cencuse', $data]);
    }


    public function selectById(Request $request,$id){
        $cencus = Cencus::findOrFail($id);
        $data =DB::table('cencuses')
        ->where('id', $request->id)
        ->get();
        return response()->json(['massage' => 'get cencuses ByID', $data]);
    }
    public function update(Request $request, $id){
        $request->validate([
            "census_number" => "required",
            "village_id" => "required",
        ]);
        $cencus = Cencus::findOrFail($id);
        $cencus['census_number'] = $request->census_number;
        $cencus['village_id'] = $request->village_id;

        $cencus->save();
        return response()->json(['status' => 'update success', $cencus]);
    }
    public function delete(Request $request, $id){
        $id = $request->id;
        $id = DB::table('cencuses')
            ->where('id', $id)
            ->delete();
        return response()->json(['massage' => 'delete success', $id]);
    }
   
    public function create(Request $request)
    {

        //validate request data form client request
        $request->validate([
            "census_number" => "string|required",
            "village_id" => "required",
         
        ]);
        // get fillable from Model Candidate and send request to data table 
        $census = new Cencus();
        $census->census_number= $request->census_number;
        $census->village_id= $request->village_id;
        $census->save();

        return response()->json(["data" => $census]);
    }

}
