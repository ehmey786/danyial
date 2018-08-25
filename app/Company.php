<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable=['group_id','name'];


    public function files()
    {
        return $this->hasMany('App\File');
    }

    public function employees()
    {
        return $this->hasMany('App\Employee');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
