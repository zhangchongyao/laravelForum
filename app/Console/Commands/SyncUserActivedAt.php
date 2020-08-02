<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
class SyncUserActivedAt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forum:sync-user-actived-at';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sync user last_actived_at...';

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
    public function handle(User $user)
    {
        $user->syncUserActivedAt();
        $this->info('sync success!');
    }
}
