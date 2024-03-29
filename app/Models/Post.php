<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['id','title','user_id','body'];

    protected $appends = ['created_at'];

    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function comments(){
        return $this->hasMany(PostComment::class,'post_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return  Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }

}
