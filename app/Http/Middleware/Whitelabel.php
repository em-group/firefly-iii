<?php

namespace FireflyIII\Http\Middleware;

use Closure;
use FireflyIII\Models\WhitelabelConfig;
use FireflyIII\Support\WhitelabelConfiguration;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Whitelabel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        static::getWhitelabel($request);

        return $next($request);
    }

    public static function handleStatic(): void
    {
        static::getWhitelabel(request());
    }

    /**
     * @param Request $request
     */
    protected static function getWhitelabel($request): void
    {
        $domain = $request->getHost();

        /** @var \FireflyIII\Models\Whitelabel $whitelabel */
        $whitelabel = \FireflyIII\Models\Whitelabel::where('domain', $domain)
            ->where('active', true)
            ->first();
        if ($whitelabel !== null) {
            static::setConfig($whitelabel);
        }
    }

    /**
     * @param \FireflyIII\Models\Whitelabel $whitelabel
     */
    static function setConfig($whitelabel)
    {
        app()->singleton(WhitelabelConfiguration::class, function () use ($whitelabel) {
            return new WhitelabelConfiguration($whitelabel);
        });

        config(['whitelabel.id' => $whitelabel->id]);

        // Overwrite existing config
        foreach ($whitelabel->config as $config) {
            /** @var WhitelabelConfig $config */
            config([$config->name => $config->value]);
        }
    }


    /**
     * Bootstrap method allows us to use the middleware as a bootstrap for console commands,
     * where we in some instances may need to set _any_ whitelabel config to use.
     * If any specific is required, it should be set by the command itself, anyway.
     * @param Application $app
     */
    public function bootstrap(Application $app)
    {
        try {
            static::setConfig(\FireflyIII\Models\Whitelabel::first());
        } catch (\Exception $ex) {
            // Ignore, might be during setup
        }
    }
}
