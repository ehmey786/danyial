<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareHolder extends Model
{
    //

    protected $fillable=['lease_date','visa_expiry','passport_expiry','lisc_expiry','name','email','dob','share','position','contact','natoionality','pre_natoionality','company_id'];
}
