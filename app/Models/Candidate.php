<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = ["name","surname","gender","dateOfBirth","degree","slogan","history","address","image"];
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    public function storeCandidateImage($image){
        $md5Name = md5_file($image->getRealPath());
    $guessExtension = $image->guessExtension();
    $fullName = $md5Name.'.'.$guessExtension;
    $image->storeAs('candidate_images', $fullName  ,'public');
    return $fullName;
    }
}
