<?php

namespace App\Jobs;

use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\SendEmailNotification;

class SendDailyEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected  $user;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user= $user;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {try{
        Mail::to($this->user->email)
        ->send(new SendEmailNotification($this->user));
    }catch (\Exception $e) {
        Log::error('Error sending email to '.$this->user->email.': '.$e->getMessage());
    }
    }}