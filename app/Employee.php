<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{


    protected $fillable = ['fi_ending_notify','passport_expiry_notify','passport_expiry','image_4', 'image_3', 'image_2', 'image_1', 'name', 'email', 'website', 'capital', 'fi_end_date', 'company_id'];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }


    public function dependents()
    {
        return $this->hasMany('App\Dpendent');
    }

}
