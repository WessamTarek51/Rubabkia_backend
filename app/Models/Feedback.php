<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $fillable = ["buyer_id","seller_id","message"];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
