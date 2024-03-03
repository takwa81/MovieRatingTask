<?php

namespace App\Jobs;

use App\Mail\VerificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class EmailVerificationJob implements ShouldQueue
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

    /**
     * Execute the job.
     */
    // public function handle(): void
    // {
    //     //
    // }

    public function handle()
{
    try {
        // ... your existing code ...

        Log::info('Email sending started');

        Mail::to($this->email['email'])->send(new VerificationMail($this->data));

        Log::info('Email sending successful');
    } catch (\Exception $e) {
        Log::error($e->getMessage());
    }

}
}
