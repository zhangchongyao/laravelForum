<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
class CalculateActiveUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forum:calculate-active-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成活跃用户';

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
     * @param User $user
     */
    public function handle(User $user)
    {
        //在命令行打印一行信息
        $this->info("Calculating...");
        $user->calculateAndCacheActiveUsers();
        $this->info('Generated successfully!');
    }
}
