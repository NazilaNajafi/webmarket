<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'groupName', 'parent_id',
    ];
    public function subgroups()
    {
        return $this->hasMany(Group::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Group::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
