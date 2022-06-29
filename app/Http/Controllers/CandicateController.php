<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CandicateController extends Controller
{
    public function __construct()
    {

        // check role 
        $this->middleware("isAdmin:api");
    }


    // create candidate 
    public function addCandidate(Request $request){

        //validate request data form client request
        $request->validate([
            "name"=>"string|required",
            "surname"=>"string|required",
            "dateOfBirth"=>"date|required",
            "degree"=>"string|required",
            "slogan"=>"string|required",
            "history"=>"string|required",
            "address"=>"string|required",
            "image"=>"image|required",

        ]);
// get fillable from Model Candidate and send request to data table 
        $candidate = new Candidate();
        $candidate->name=$request->name;
        $candidate->surname=$request->surname;
        $candidate->dateOfBirth=$request->dateOfBirth;
        $candidate->degree=$request->degree;
        $candidate->slogan=$request->slogan;
        $candidate->history=$request->history;
        $candidate->address=$request->address;

        // add image from function storeCandidateImage in 
        $candidate->image = $candidate->storeCandidateImage($request->image);
        $candidate->save();

        return response()->json(["data"=>$candidate]);
    }


    public function delete(Request $request){
        $id = $request->id;
        $id = DB::table('candidates')
        ->where('id',$id)
        ->delete();
        return response()->json(['massage'=>'delete success',$id]);
      
    }
    public function update(Request $request){
        $candidate =array();
       function storeCandidateImage($image){
            $md5Name = md5_file($image->getRealPath());
        $guessExtension = $image->guessExtension();
        $fullName = $md5Name.'.'.$guessExtension;
        $image->storeAs('candidate_images', $fullName  ,'public');
        return $fullName;
        }
        $id = $request->id;
        $candidate['name'] = $request->name;
        $candidate['surname'] = $request->surname;
        $candidate['dateOfBirth'] = $request->dateOfBirth;
        $candidate['degree'] = $request->degree;
        $candidate['slogan'] = $request->slogan;
        $candidate['history'] = $request->history;
        $candidate['address'] = $request->address;
        
        $data_update = DB::table('candidates')
                        ->where('id',$id)
                        ->update($candidate);
                         return response()->json(['status'=>'update success',$data_update  ]);
      
      
    }

    

    public function getAllcandidates(Request $request){
        $data =DB::table('candidates')
        ->get();
        return response()->json(['massage'=>'get succesefully',$data]);
      
    }

}
