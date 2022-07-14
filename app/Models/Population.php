<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    
    use HasFactory;
    protected $fillable = ["name","surname", "phoneNumber","dateOfBirth","address","image","cencus_id"];

    public function cencuses(){
        return $this->belongsTo(Cencus::class);
    }

    public function votes()
    {
        return $this->hasOne(Vote::class);
    }

    // public function populations(){
    //     return $this->belongsTo(Population::class);
    // }
    public function storePopulationsImage($image){
        $md5Name = md5_file($image->getRealPath());
    $guessExtension = $image->guessExtension();
    $fullName = $md5Name.'.'.$guessExtension;
    $image->storeAs('populations_images', $fullName  ,'public');
    return $fullName;
    }
}
