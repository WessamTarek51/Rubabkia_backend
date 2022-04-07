<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usermessage extends Model
{
    protected $fillable = ["admin_id","user_id","name","message"];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
