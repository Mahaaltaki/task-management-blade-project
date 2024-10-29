<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Jobs\SendDailyEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-mail';//يعني كيف رح نادي هذا الكومند

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';//وصف

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::with(['tasks' => function ($query) {
            $query->where('status', 'Pending');}])->get();
        foreach ($users as $user) {
            if ($user->tasks->isNotEmpty()) {
            SendDailyEmail::dispatch($user);}
        }

        $this->info('Emails queued for sending!');
    }
}
