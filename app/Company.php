<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable=['vat_date','other_activity','main_activity','address','email','zone','issue_date','lic_no','group_id','name','phone','card','origin','date_inc','a_name','a_number','expiry'];


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

    public function shareHolders()
    {
        return $this->hasMany('App\ShareHolder');
    }
}
