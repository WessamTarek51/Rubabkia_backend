<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adminmessage extends Model
{
    protected $fillable = ["admin_id","user_id","message"];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
