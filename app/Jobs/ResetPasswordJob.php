<?php

namespace App\Jobs;

use App\Mail\ResetPasswordMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class ResetPasswordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $data ;
    public $email ;
    public function __construct($data , $email)
    {
        $this->data = $data ;
        $this->email = $email ;
    }

  

    public function handle()
{
    try {
        // ... your existing code ...

        Log::info('Email sending Reset Password started');

        Mail::to($this->email['email'])->send(new ResetPasswordMail($this->data));

        Log::info('Email sending successful');
    } catch (\Exception $e) {
        Log::error($e->getMessage());
    }

}
}
