<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable=['product_id','imageUrl'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
