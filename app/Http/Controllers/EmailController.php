<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Log;
use Carbon\Carbon;
use App\Company;
use App\ShareHolder;
use App\Mail\BirthdayEmails;

class EmailController extends Controller
{
    //
    public function sendBirdayEmail(){
        $users = ShareHolder::where('dob','like', '%'.Carbon::parse(Carbon::now())->format('m-d').'%')->get();
        //dd(Carbon::parse(Carbon::now())->format('m-d'));
        foreach($users as $user){
            Mail::to($user)->send(new BirthdayEmails("<b>".$user->name."</b> SME wishes you Happy Birthday on this speial ocassion."));
        }

    }




    public function sendExpiryEmail(){dd(Carbon::parse(Carbon::now()->addMonth())->format('Y-m-d'));
    if(Carbon::parse(Carbon::now()->addMonth())->format('Y-m-d') > "2018-10-21"){dd(Carbon::now()->addMonth());}



        $companies = Company::where('expiry','like', '%'.Carbon::parse(Carbon::now())->format('m-d').'%')->get();
       dd($companies);
        foreach($companies as $company){

        }
    }

}
