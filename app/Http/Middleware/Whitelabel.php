<?php

namespace FireflyIII\Http\Middleware;

use Closure;
use FireflyIII\Models\WhitelabelConfig;
use FireflyIII\Support\WhitelabelConfiguration;
use Illuminate\Http\Request;

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
}
