<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=['_date','c_name','comments','zone','p_name','n_concern','status'];
}
