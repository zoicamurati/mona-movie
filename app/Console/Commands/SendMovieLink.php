<?php

namespace App\Console\Commands;

use App\Mail\SendLinkMail;
use App\Notifications\UserEmail;
use Illuminate\Console\Command;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Mail;

class SendMovieLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-movie-link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send movie link in 25 december';

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
        $users = \App\Models\User::where('role', 0)
            ->whereHas('invoices', function ($q) {
                $q->where('status', 1);
            })
            ->orderBy('created_at', 'desc')->get();

        foreach ($users as $user) {

            //send email
            try {
                $user->notify(new UserEmail());

            } catch (\Exception $e) {
                \Log::info($e->getMessage());
            }


        }
    }
}
