<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    public function saler()
    {
        return $this->belongsTo(User::class);

    }
    protected $fillable  = ["name", "price","description","user_id","image"];
}
