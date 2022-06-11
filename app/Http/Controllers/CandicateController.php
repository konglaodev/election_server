<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CandicateController extends Controller
{
    public function __construct()
    {
        $this->middleware("isAdmin:api");
    }

    public function addCandidate(Request $request){
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

        $candidate = new Candidate();
        $candidate->name=$request->name;
        $candidate->surname=$request->surname;
        $candidate->dateOfBirth=$request->dateOfBirth;
        $candidate->degree=$request->degree;
        $candidate->slogan=$request->slogan;
        $candidate->history=$request->history;
        $candidate->address=$request->address;
        $candidate->image = $candidate->storeCandidateImage($request->image);
        $candidate->save();

        return response()->json(["data"=>$candidate]);
    }

}
