<?php

namespace FireflyIII\Providers;

use FireflyIII\Support\WhitelabelConfiguration;
use Illuminate\Support\ServiceProvider;

class WhitelabelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'whitelabelconfig',
            WhitelabelConfiguration::class
        );
    }
}
