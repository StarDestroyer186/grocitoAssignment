<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = ['name','state_id','city_id','pincode_id'];

    public function city()
    {
        return $this->hasOne(Cities::class);
    }

    public function pincode()
    {
        return $this->hasOne(Pincode::class);
    }

    public function state()
    {
        return $this->hasOne(States::class);
    }
}
