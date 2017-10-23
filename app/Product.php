<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'discount_id', 'group_id', 'title','detail','quantity','price','photo'
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function getDetailAttribute($detail)
    {
        return nl2br($detail);
    }

}
