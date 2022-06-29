<?php

namespace App\Http\Controllers;

use App\Models\Population;
use Illuminate\Http\Request;

class PopulationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("isAdmin:api");
    }

    public function addPopulation(Request $request){
        $request->validate([
            "name"=>"string|required",
            "surname"=>"string|required",
            "phoneNumber"=>"string|required",
            "dateOfBirth"=>"date|required",
            "address"=>"string|required",
            "image"=>"image|required",
            "cencus_id"=>"unsignedBigInteger|required",
        
           
        ]);

        $population = new Population();
        $population->name=$request->name;
        $population->surname=$request->surname;
        $population->phoneNumber=$request->phoneNumber;
        $population->dateOfBirth=$request->dateOpopulation;
        $population->address=$request->address;
        $population->image = $population->storePopulatedImage($request->image);
        $population->cencus_id = $request->cencus_id;
        $population->save();

        return response()->json(["data"=>$population]);
    }
}
