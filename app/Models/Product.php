<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
//fav product to many users
    public function userfav()
    {
        return $this->hasMany(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable  = ["name", "price","description","user_id","category_id","image"];
}
