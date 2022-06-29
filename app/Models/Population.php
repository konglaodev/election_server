<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    use HasFactory;
    protected $fillable = ["name","surname", "phoneNumber","dateOfBirth","address","image","cencus_id"];



    public function storePopulatedImag($image){
        $md5Name = md5_file($image->getRealPath());
    $guessExtension = $image->guessExtension();
    $fullName = $md5Name.'.'.$guessExtension;
    $image->storeAs('Population_images', $fullName  ,'public');
    return $fullName;
    }use HasFactory;
}
