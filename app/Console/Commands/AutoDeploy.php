<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AutoDeploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'git:deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        //
        exec('php7.3 artisan down');
        exec('git pull');
        exec('composer-php7.3 install --no-interaction --no-dev --prefer-dist');
        exec('composer-php7.3 update');
        exec('php7.3 artisan migrate:fresh --seed --force');
        exec('php7.3 artisan config:cache');
        exec('php7.3 artisan route:cache');
        exec('php7.3 artisan view:cache');
        exec('npm install');
        exec('npm run prod');
        exec('php7.3 artisan up');
    }
}
