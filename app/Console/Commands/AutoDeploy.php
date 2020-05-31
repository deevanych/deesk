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
//        $base = base_path();
//        exec('cd '.$base.' && ls', $re);
//        exec('cd '.$base.' && php7.3 artisan down', $re);
//        exec('cd '.$base.' && git pull', $re);
//        exec('cd '.$base.' && composer-php7.3 install --no-interaction --no-dev --prefer-dist', $re);
//        exec('cd '.$base.' && composer-php7.3 update', $re);
//        exec('cd '.$base.' && php7.3 artisan migrate:fresh --seed --force');
//        exec('cd '.$base.' && php7.3 artisan config:cache');
//        exec('cd '.$base.' && php7.3 artisan route:cache');
//        exec('cd '.$base.' && php7.3 artisan view:cache', $re);
//        exec('cd '.$base.' && npm install', $re);
//        exec('cd '.$base.' && npm run prod');
//        exec('cd '.$base.' && php7.3 artisan up');
//        return dd($re);
    }
}
