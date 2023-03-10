<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class)->select(['id','name']);
    }

    public function readings()
    {
        return $this->hasMany(WaterReading::class);
    }
}
