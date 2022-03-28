<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $fillable = ['id','name'];
    public function products()
    {
        return $this->hasMany(User::class);
    }
}
