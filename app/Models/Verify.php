<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verify extends Model
{
    use HasFactory;

    protected $fillable = 
    [
    "user_id", 
    "picture_verify",
    "status",
    
];

public function storeVerifyImage($image){
    $md5Name = md5_file($image->getRealPath());
$guessExtension = $image->guessExtension();
$fullName = $md5Name.'.'.$guessExtension;
$image->storeAs('verifys_images', $fullName  ,'public');
return $fullName;
}
}
