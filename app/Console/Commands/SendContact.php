<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendContact extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:contact';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails stored in database';

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
     * @return int
     */
    public function handle()
    {
        app()->call('App\Http\Controllers\EmailController@processUnsentEmails');
    }
}
