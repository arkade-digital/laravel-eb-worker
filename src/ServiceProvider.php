<?php

namespace Arkade\ElasticBeanstalkWorker;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            $this->app['router']->post('worker/receive', QueueController::class.'@receive');
            $this->app['router']->post('worker/schedule', QueueController::class.'@schedule');
        }
    }
}