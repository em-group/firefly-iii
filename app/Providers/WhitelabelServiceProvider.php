<?php

namespace FireflyIII\Providers;

use FireflyIII\Repositories\Whitelabel\WhitelabelRepository;
use FireflyIII\Repositories\Whitelabel\WhitelabelRepositoryInterface;
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
            'FireflyIII\Support\WhitelabelConfiguration'
        );

        $this->app->bind(WhitelabelRepositoryInterface::class, WhitelabelRepository::class);
    }
}
