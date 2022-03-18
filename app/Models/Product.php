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
    public function favorite()
    {
        // $cid=auth()->guard('user')->user()!=null ? auth()->guard('user')->user()->id : null;
        $cid= auth()->user()->id;
        return $this->hasMany(Favproduct::class,'id','product_id')->where('user_id',$cid);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function like(){
        return $this->favorite()->selectRaw('product_id,count(*) as count')->groupBy('product_id');
    }

    public function notification()
    {
        return $this->hasMany(Notification::class);
    }

    // public function acceptmessage()
    // {
    //     return $this->belongsTo(Acceptedmessage::class);
    // }


    protected $fillable  = ["name", "price","description","user_id","category_id","image"];
}
