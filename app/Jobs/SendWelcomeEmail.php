<?php

namespace App\Jobs;

use App\Mail\WelcomeEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $test;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($test)
    {
        $this->test = $test;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sleep(30);


        echo 'Start send email';
        $email = new WelcomeEmail($this->test);
        Mail::to('12013814332@mailinator.com')->send($email);

        echo 'End send email';
    }
}
