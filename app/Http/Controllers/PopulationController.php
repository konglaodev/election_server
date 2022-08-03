<?php

namespace App\Http\Controllers;

use App\Models\Population;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PopulationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("isAdmin:api");
    }
    public function create( Request $request){

        $request->validate([
            "name"=>"string|required",
            "surname"=>"string|required",
            "phoneNumber"=>"string|required",
            "dateOfBirth"=>"date|required",
            "address"=>"string|required",
            "image"=>"image|required",
            "cencus_id"=>"required",
        
        ]);

        $population = new Population();
        $population->name=$request->name;
        $population->surname=$request->surname;
        $population->phoneNumber=$request->phoneNumber;
        $population->dateOfBirth=$request->dateOfBirth;
        $population->address=$request->address;
        $population->image = $population->storePopulationsImage($request->image);
        $population->cencus_id= $request->cencus_id;
        $population->save();     
        return response()->json(["data" => $population]);
    }
    public function update(Request $request, $id){
        $request->validate([
            "name"=>"string|required",
            "surname"=>"string|required",
            "phoneNumber"=>"string|required",
            "dateOfBirth"=>"date|required",
            "address"=>"string|required",
            "image"=>"image|required",
            "cencus_id"=>"required",
        ]);

        $population = Population::findOrFail($id);
        $md5Name = md5_file($request->image->getRealPath());
            $guessExtension = $request->image->guessExtension();
            $fullName = $md5Name . '.' . $guessExtension;
            $request->image->storeAs('populations_images', $fullName, 'public');

            $population['name']= $request->name;
            $population['surname']= $request->surname;
            $population['phoneNumber']= $request->phoneNumber;
            $population['dateOfBirth']= $request->dateOfBirth;
            $population['address']= $request->address;
            $population['image']= $fullName;
            $population['cencus_id']= $request->cencus_id;
            $population->save();


            return response()->json(['status'=>'update success',$population]);
    }
 
    
    public function getPulationsById(Request $request,$id){
        $population = Population::findOrFail($id);
        $data =DB::table('populations')
        ->where('id', $request->id)
        ->get();
        return response()->json(['massage' => 'get ByID  succesefully', $data]);
    }
    public function index(Request $request)
    {
        $data = DB::table('populations')
            ->get();
        return response()->json(['massage' => 'get succesefully', $data]);
    }
    public function delete(Request $request, $id)
    {
        $id = $request->id;
        $id = DB::table('populations')
            ->where('id', $id)
            ->delete();
        return response()->json(['massage' => 'delete success', $id]);
    }
 
}
