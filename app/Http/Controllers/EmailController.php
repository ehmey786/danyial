<?php

namespace App\Http\Controllers;

use App\Mail\CompanyExpiryEmails;
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
    public function sendBirdayEmail()
    {
        $users = ShareHolder::where('dob', 'like', '%' . Carbon::parse(Carbon::now())->format('m-d') . '%')->get();
        //dd(Carbon::parse(Carbon::now())->format('m-d'));
        foreach ($users as $user) {
            try {
                Mail::to($user)->send(new BirthdayEmails("<b>" . $user->name . "</b> SME wishes you Happy Birthday on this speial ocassion."));
            } catch (\Exception $exception) {

            }
        }

    }


    public function sendExpiryEmail()
    {
        $dataCompareNextMonth = Carbon::parse(Carbon::now()->addMonth())->format('Y-m');
        $dataCompare = Carbon::parse(Carbon::now())->format('Y-m');

        $companies = Company::where('expiry', 'like', '%' . $dataCompareNextMonth . '%')->orWhere('expiry', 'like', '%' . $dataCompare . '%')->get();
        foreach ($companies as $company) {
            if (Carbon::parse(Carbon::now()->addMonth())->format('Y-m-d') > $company->expiry) {
                try {
                    Mail::to($company)->send(new CompanyExpiryEmails("Your <b>" . $company->name . "</b> Company expiry date is comming."));
                } catch (\Exception $exception) {
                    echo $exception->getMessage();
                }
            }
        }
    }

}
