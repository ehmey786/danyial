<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=['user_id','remarks','_date','c_name','comments','zone','p_name','n_concern','status'];

    public function commentss()
    {
        return $this->hasMany('App\Comment');
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
