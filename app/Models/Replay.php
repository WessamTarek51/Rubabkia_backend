<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replay extends Model
{
    protected $table = 'replays';
    protected $fillable = ["buyer_id","seller_id","message"];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
