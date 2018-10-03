<?php

namespace App\Console\Commands;

use App\Http\Controllers\EmailController;
use Illuminate\Console\Command;

class ExpiryEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:ExpiryEmails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Used to Send Expiry Emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        (new EmailController())->sendExpiryEmail();
    }
}
