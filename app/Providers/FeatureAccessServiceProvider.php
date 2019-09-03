<?php

namespace FireflyIII\Providers;


use FireflyIII\Http\Middleware\FeatureAccess;
use Illuminate\Support\ServiceProvider;

class FeatureAccessServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('feature', FeatureAccess::class);
    }
}