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
    return response()->json(['massage' => 'get data cencuse','data'=> $data]);
    }


    public function selectById(Request $request,$id){
        $cencus = Cencus::findOrFail($id);
        if($cencus){
            $data =DB::table('cencuses')
            ->where('id', $request->id)
            ->get();
            return response()->json(['massage' => 'get cencuses ByID', $data]);
        }
    
}
    public function update(Request $request, $id){
        $request->validate([
            "cencus_id" => "integer|required",
            "village_id" => "string|required",
        ]);


        $cencuses = Cencus::findOrFail($id);
        $cencuses['cencus_id'] = $request->cencus_id;
        $cencuses['village_id'] = $request->village_id;

        $cencuses->save();


        return response()->json(['status' => 'update success', $cencuses]);
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
            "cencus_id" => "string|required",
            "village_id" => "required",
         
        ]);
        // get fillable from Model Candidate and send request to data table 

        $cencus_id = Cencus::where('cencus_id', $request->cencus_id)->first();

          
        if ($cencus_id) {


            return response()->json(["massage" => 'ເລກສຳມະໂນຊ້ຳກັນ']);

        } else if (!$cencus_id) {
        $cencus = new Cencus();
        $cencus->cencus_id= $request->cencus_id;
        $cencus->village_id= $request->village_id;
        $cencus->save();
    
        return response()->json(["data" => $cencus]);
        }
    }

}
