<?php

namespace App\Providers;

use App\Activity;
use App\Issue;
use App\IssueComment;
use App\Notification;
use App\Observers\ActivityObserver;
use App\Observers\IssueCommentObserver;
use App\Observers\IssueObserver;
use App\Observers\NotificationObserver;
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
        Activity::observe(ActivityObserver::class);
        Notification::observe(NotificationObserver::class);
        setlocale(LC_TIME, 'ru_RU.UTF-8');
        Carbon::setLocale(config('app.locale'));
    }
}
