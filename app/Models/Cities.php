<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;

    protected $fillable = ['city','states_id'] ;

    public function state()
    {
        return $this->belongsTo(States::class);
    }

    public function pincode()
    {
        return $this->hasMany(Pincode::class);
    }
}
