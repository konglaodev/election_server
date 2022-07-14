<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cencus extends Model
{
    use HasFactory;
    protected $fillable = ["cencus_number","village"];
    public function village_numbers(){
        return $this->belongsTo(VillageNumber::class);
    }
    public function population(){
        return $this->hasMany(Population::class);
    }
    
   
}
