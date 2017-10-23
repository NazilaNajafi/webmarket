<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['author','mail','body','status'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function rateLogs()
    {
        return $this->hasMany(Ratelog::class);
    }

}
