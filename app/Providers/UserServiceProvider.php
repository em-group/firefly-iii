<?php

namespace FireflyIII\Providers;


use EM\Hub\Models\UserInterface;
use FireflyIII\User;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(UserInterface::class, User::class);
    }
}