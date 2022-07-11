<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cencus extends Model
{
    use HasFactory;
    protected $fillable = ["censuse_number"];
    public function villages(){
        return $this->hasMany(Census::class);
    }
}
