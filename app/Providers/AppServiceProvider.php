<?php

namespace App\Providers;

use App\Issue;
use App\IssueComment;
use App\Observers\IssueCommentObserver;
use App\Observers\IssueObserver;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Issue::observe(IssueObserver::class);
        IssueComment::observe(IssueCommentObserver::class);
        setlocale(LC_TIME, 'ru_RU.UTF-8');
        Carbon::setLocale(config('app.locale'));
    }
}
