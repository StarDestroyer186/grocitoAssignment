<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $table = 'otp';

    protected $fillable = ['otp'];

    public function otp(){
        return $this->belongsTo(User::class);
    }
}
