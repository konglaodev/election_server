<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageNumber extends Model
{
    use HasFactory;
    protected $fillable = ["number"];
    public function cencuses(){
        return $this->hasMany(Cencus::class);
    }

}
