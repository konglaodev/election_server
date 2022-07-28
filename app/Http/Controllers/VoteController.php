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

        }
        
        
        else if (!$population_id) {

            $vote = new Vote();
            $vote->population_id = $request->population_id;
            $vote->candidate_id = $request->candidate_id;
            
            $vote->save();
            return response()->json(["massage" => 'voted', $vote]);
        }
    }
    public function getScore(Request $request) {
      
        $votes=DB::select('SELECT populations.name as population_name ,candidates.name as candidate_name from populations,candidates,votes WHERE votes.population_id=populations.id and candidates.id=votes.candidate_id;');

        return response()->json(['massage' =>'getCandidate and population yourvote',$votes]);

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
