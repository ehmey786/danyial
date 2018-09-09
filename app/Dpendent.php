<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dpendent extends Model
{
    protected $fillable=['visa_expiry_notify','passport_expiry_notify','employee_id','name','relation','passport_expiry','visa_expiry_expiry','document'];

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

}
