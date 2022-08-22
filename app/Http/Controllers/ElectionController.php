<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Election;
class ElectionController extends Controller
{
    public function addimage(Request $request)
    {
        $request->validate([
            "image" => "required",
           
        ]);
        // get fillable from Model verifies and send request to data table 
        $Verifys = new Election();
        
        $Verifys->image = $Verifys->storeElectionsImage($request->image);

        $Verifys->save();


        return response()->json(["data" => $Verifys]);
    }
    public function show()
    {
        //$verifies = Verify::findOrFail($id);
        
        $data = DB::table('elections')
            
            ->get();
        return response()->json(["data" => $data]);
    }
}
