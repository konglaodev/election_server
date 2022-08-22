<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;
    
    protected $fillable = 
    [
    
    "image",
   
    
];

public function storeElectionsImage($image){
    $md5Name = md5_file($image->getRealPath());
$guessExtension = $image->guessExtension();
$fullName = $md5Name.'.'.$guessExtension;
$image->storeAs('Elections_images', $fullName  ,'public');
return $fullName;
}
    
}
