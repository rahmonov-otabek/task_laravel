<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CheckUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $inactiveUsers = User::where('last_login', '<', now()->subDay(3))->get();
        
         
        foreach ($inactiveUsers as $user) {
            $user->update(['is_active' => false]);
        }
    }
}
