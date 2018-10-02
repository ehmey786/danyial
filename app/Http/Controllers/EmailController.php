<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Log;
use Carbon\Carbon;
use App\ShareHolder;
use App\Mail\BirthdayEmails;

class EmailController extends Controller
{
    //
    public function sendBirdayEmail(){
      //  dd();
        Log::info("aa");
        $users = ShareHolder::where('dob',Carbon::now()->toDateString())->get();
        foreach($users as $user){
            Mail::to($user)->send(new BirthdayEmails("<b>".$user->name."</b> SME wishes you Happy Birthday on this speial ocassion."));
        }

    }
}
