<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=['remarks','_date','c_name','comments','zone','p_name','n_concern','status'];
}
