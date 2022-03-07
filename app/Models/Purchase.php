<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function buyer()
    {
        return $this->belongsTo(User::class);
    }
    protected $fillable  = ["name", "price","description","user_id","image"];
}
