<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acceptedmessage extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = ["message","buyer_id","seller_id","productname","productimage"];
}
