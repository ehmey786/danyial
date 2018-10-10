<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareHolder extends Model
{
    //

    protected $fillable=[
        'status',

        'visa_expiry',
        'passport_expiry',

        'name',
        'email',
        'dob',
        'share',
        'position',
        'contact',
        'natoionality',
        'pre_natoionality',
        'company_id'];
}
