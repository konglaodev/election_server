<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Population;
use App\Models\Candidate;
use App\Models\Cencus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class VoteController extends Controller
{
    public function __construct()
    {

        // check role 
        // $this->middleware("auth:api");
    }
    public function create(Request $request)
    {
        $request->validate([
            "population_id" => "required",
            "candidate_id" => "required",
        ]);
       
        $population = Population::where("id", "=", $request->population_id)->with("cencuses")->first();

      
        $population_id = Vote::where('population_id', $request->population_id)
        ->first();  
        // $status = "verify"; 
        // if($population_id){
        //     $checkverify= DB::select('SELECT populations.phoneNumber FROM Populations WHERE populations.id = '.$population_id );
           
        // }

        if ($population_id) {
            return response()->json(["massage" => 'ໂວດໄດ້ເທື່ອດຽວເດິກະໂປກ']);
        }          
        
        $population = Population::where("id", "=", $request->population_id)->with("cencuses")->first();

        $current_population_cencus = $population->cencus_id;
        $check_vote_cencus = DB::table("votes")
        ->select("*")
        ->leftJoin("populations","populations.id","=","votes.population_id")
        ->where("populations.cencus_id",$current_population_cencus)
        ->first();
        if($check_vote_cencus){
            return response()->json(["massage"=>"ສາມາດໂວດໄດ້ ບ້ານລະຄົນ"]);
        }
        
        $vote = new Vote();
            $vote->population_id = $request->population_id;
            $vote->candidate_id = $request->candidate_id;
            
            $vote->save();
            return response()->json(["massage" => 'voted', $vote]);
        
    }
    public function getScore(Request $request) {
      
        $votes=DB::select('SELECT populations.name ,candidates.name,COUNT(votes.candidate_id) as score FROM votes,populations,candidates where votes.population_id=populations.id AND votes.candidate_id =candidates.id
        ORDER BY score DESC;');

        return response()->json($votes);

    }
    public function getScoreAll(Request $request) {
      
        $votes = DB::table('votes')
        ->select(
            'candidates.name AS candidate_name',
            'candidates.surname AS candidate_surname',
            'candidates.image AS candidate_image',
        DB::raw('count(votes.candidate_id) as votes_count')
        )
        ->leftJoin('candidates', 'votes.candidate_id',"=",'candidates.id')
        ->leftJoin('populations', 'votes.population_id',"=",'populations.id')
        ->groupBy('votes.candidate_id')
        ->orderby('votes_count', 'Desc')
        ->get();

     
// populations.name, candidates.name ,COUNT(votes.candidate_id)

        return response()->json(['massage'=>'getCandidate and population yourvote',"Data"=>$votes]);

    }

    
}
