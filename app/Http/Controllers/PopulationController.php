<?php

namespace App\Http\Controllers;

use App\Models\Population;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

class PopulationController extends Controller
{
    //
    public function __construct()
    {
        // $this->middleware("isAdmin:api");
    }
    public function create( Request $request){

        $request->validate([
            "name"=>"string|required",
            "surname"=>"string|required",
            "gender"=>"string|required",
            "phoneNumber"=>"string|required",
            "dateOfBirth"=>"date|required",
            "address"=>"string|required",
            "image"=>"image|required",
            "cencus_id"=>"required",
        
        ]);

        $md5Name = md5_file($request->image->getRealPath());
        $guessExtension = $request->image->guessExtension();
        $fullName = $md5Name . '.' . $guessExtension;
        $request->image->storeAs('populations_images', $fullName, 'public');

        $population = new Population();
        $population->name=$request->name;
        $population->surname=$request->surname;
        $population->gender=$request->gender;
        $population->phoneNumber=$request->phoneNumber;
        $population->dateOfBirth=$request->dateOfBirth;
        $population->address=$request->address;
        $population->image=$fullName;
        $population->cencus_id= $request->cencus_id;
        $population->save();     
        return response()->json(["data" => $population]);
    }
    public function update(Request $request, $id){
        

        $population = Population::findOrFail($id);
            if($request->image !== null && $request->image !== 'null'){
                $md5Name = md5_file($request->image->getRealPath());
                $guessExtension = $request->image->guessExtension();
                $fullName = $md5Name . '.' . $guessExtension;
                $request->image->storeAs('populations_images', $fullName, 'public');
                $population['image']= $fullName;
            }

            $population['name']= $request->name;
            $population['surname']= $request->surname;
            $population['gender']= $request->gender;
            $population['phoneNumber']= $request->phoneNumber;
            $population['dateOfBirth']= $request->dateOfBirth;
            $population['address']= $request->address;
         
            $population['cencus_id']= $request->cencus_id;
            $population->save();


            return response()->json(['status'=>'update success','data'=>$population]);
    }
 
    
    public function getPulationsById(Request $request,$id){
        $population = Population::findOrFail($id);
        $data =DB::table('populations')
        ->where('id', $request->id)
        ->get();
        return response()->json(['massage' => 'get ByID  succesefully', 'data'=>$data]);
    }
    public function index(Request $request)
    {
        $data = DB::table('populations')
            ->get();
        return response()->json(['massage' => 'get succesefully','data' => $data]);
    }
    public function showpopulations()
    {
        $verify= DB::select('SELECT populations.gender,populations.name,populations.surname,populations.image,populations.dateOfBirth,populations.phoneNumber,cencuses.cencus_id FROM populations, votes ,cencuses WHERE populations.cencus_id= cencuses.id and populations.id = votes.population_id;');
 
        return response()->json(['data'=>$verify]);
    }
    public function delete(Request $request, $id)
    {
        $id = $request->id;
        $id = DB::table('populations')
            ->where('id', $id)
            ->delete();
        return response()->json(['massage' => 'delete success','data'=> $id]);
    }
 
}
