<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ratelog extends Model
{
    protected $fillable=['userIp'];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
