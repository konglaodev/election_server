<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CandicateController extends Controller
{
    public function __construct()
    {

       
        // $this->middleware("auth:api");
    }


    // create candidate 
    public function addCandidate(Request $request)
    {

        //validate request data form client request
        $request->validate([
            "name" => "string|required",
            "surname" => "string|required",
            "gender" => "string|required",
            "dateOfBirth" => "date|required",
            "degree" => "string|required",
            "slogan" => "string|required",
            "history" => "string|required",
            "address" => "string|required",
            "image" => "image|required",

        ]);
        // get fillable from Model Candidate and send request to data table 
        $candidate = new Candidate();
        $candidate->name = $request->name;
        $candidate->surname = $request->surname;
        $candidate->gender = $request->gender;
        $candidate->dateOfBirth = $request->dateOfBirth;
        $candidate->degree = $request->degree;
        $candidate->slogan = $request->slogan;
        $candidate->history = $request->history;
        $candidate->address = $request->address;

        // add image from function storeCandidateImage in 
        $candidate->image = $candidate->storeCandidateImage($request->image);
        $candidate->save();

        
    }


    public function delete(Request $request, $id)
    {
       $id= $request->id;
        $id = DB::table('candidates')
            ->where('id', $id)
            ->delete();
        return response()->json(['massage' => 'delete success', $id]);
    }
    public function update(Request $request,$id)
    {
      
       
        $candidate = Candidate::findOrFail($id);
       // $candidate = array();
  
      
      if($request->image !== null && $request->image !== "null"){
        
        $md5Name = md5_file($request->image->getRealPath());
        $guessExtension = $request->image->guessExtension();
        $fullName = $md5Name . '.' . $guessExtension;
        $request->image->storeAs('candidate_images', $fullName, 'public');
        $candidate['image'] = $fullName;
      }
        
      //  $id = $request->id;
        $candidate['name'] = $request->name;
        $candidate['surname'] = $request->surname;
        $candidate['gender'] = $request->gender;
        $candidate['dateOfBirth'] = $request->dateOfBirth;
        $candidate['degree'] = $request->degree;
        $candidate['slogan'] = $request->slogan;
        $candidate['history'] = $request->history;
        $candidate['address'] = $request->address;
      
        $candidate->save();

        // $data_update = DB::table('candidates')
        //     ->where('id', $id)
        //     ->update($candidate);
        return response()->json(['status' => 'update success','data'=> $candidate]);
    }



    public function getAllcandidates(Request $request)
    {
        $data = DB::table('candidates')
            ->get();
        return response()->json(['data'=>$data]);
    }

    public function getCandidatesById(Request $request,$id){
        $candidate = Candidate::findOrFail($id);
        $data =DB::table('candidates')
        ->where('id', $request->id)
        
        ->get();
        return response()->json(['massage' => 'get ByID  succesefully', $data]);
    }
}
