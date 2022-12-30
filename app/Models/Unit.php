<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function readings()
    {
        return $this->hasMany(WaterReading::class);
    }

}
