<?php

namespace App\Providers;

use App\Issue;
use App\IssuePriority;
use App\IssueRule;
use App\IssueStatus;
use App\IssueType;
use App\Organization;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();

        Route::bind('type', function ($id) {
            return IssueType::withTrashed()->find($id);
        });
        Route::bind('priority', function ($id) {
            return IssuePriority::withTrashed()->find($id);
        });
        Route::bind('status', function ($id) {
            return IssueStatus::withTrashed()->find($id);
        });
        Route::bind('rule', function ($id) {
            return IssueRule::withTrashed()->find($id);
        });
        Route::bind('organization', function ($id) {
            return Organization::find($id);
        });
        Route::bind('issue', function ($id) {
            return Issue::withTrashed()->find($id);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
