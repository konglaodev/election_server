<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    protected $fillable = ["population_id","candidate_id"];
    public function populations(){

        return $this->hasOne(Population::class);
        
    }
    public function candidates(){
        return $this->belongsTo(Candidate::class);
    }
}
