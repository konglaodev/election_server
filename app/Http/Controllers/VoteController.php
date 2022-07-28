<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Population;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class VoteController extends Controller
{
    public function __construct()
    {

        // check role 
        // $this->middleware("isAdmin:api");
    }
    public function create(Request $request)
    {
        $request->validate([
            "population_id" => "required",
            "candidate_id" => "required",
        ]);
        
        $population_id = Vote::where('population_id', $request->population_id)->first();

          
        if ($population_id) {


            return response()->json(["massage" => 'ໂວດໄດ້ເທື່ອດຽວເດິກະໂປກ']);

        } else if (!$population_id) {

            $vote = new Vote();
            $vote->population_id = $request->population_id;
            $vote->candidate_id = $request->candidate_id;
            
            $vote->save();
            return response()->json(["massage" => 'voted', $vote]);
        }
    }
    public function getScore(Request $request) {

        
    }
}
