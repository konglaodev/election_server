<?php

namespace App\Http\Controllers;
use App\Models\Population;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShowAllController extends Controller
{
    public function showimagesCandidate(){
        
            $images = DB::select('select image from candidates;');
        //     return response()->json([$images]);
            return response()->json(['data' => $images]);
    }
    public function showcandidate(){
            $candidate = DB::select('SELECT candidates.gender,candidates.name,candidates.surname,candidates.dateOfBirth,candidates.degree,candidates.slogan,candidates.history,candidates.image FROM candidates;');
            return response()->json(['data'=>$candidate]);
    }
    public function sumvote_score_all(){
            $candidate = DB::select('SELECT count(votes.population_id) as scorevoted FROM votes;');
            return response()->json(['data'=>$candidate]);
    }
    public function count_score_people_can_vote(){
            $candidate = DB::select('SELECT COUNT(cencuses.id) as cencuses FROM cencuses;');
            return response()->json(['data'=>$candidate]);
    }
    public function showAllscore(){
            $candidate = DB::select('SELECT candidates.gender, candidates.name ,candidates.surname  ,COUNT( votes.population_id) as score FROM votes,candidates WHERE votes.candidate_id= candidates.id;');
            return response()->json(['data'=>$candidate]);
    }
    public function showdetail(Request $request,$id){
        $users = DB::select('SELECT users.name,users.status,users.phoneNumber,populations.gender,populations.name,populations.surname,populations.phoneNumber, verifies.picture_verify,verifies.status, populations.image FROM users,verifies,populations WHERE populations.phoneNumber=users.phoneNumber AND verifies.user_id = users.id'.$id);

        return response()->json(['data'=>$users]);
   
}
public function canvoted(){
        $users = DB::select('SELECT COUNT(cencuses.id) as canvoted FROM cencuses;');

        return response()->json(['data'=>$users]);
}
public function reportVoting(){
        $users = DB::select('SELECT populations.gender as pgen, populations.name as pname,populations.surname as psur ,candidates.gender as gcan, candidates.name cname,candidates.surname as cansur FROM candidates,votes,populations WHERE populations.id = votes.population_id AND candidates.id =votes.candidate_id;');

        return response()->json(['data'=>$users]);
}
}
