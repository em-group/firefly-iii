<?php

namespace FireflyIII\Http\Middleware;

use Closure;
use FireflyIII\Models\WhitelabelConfig;
use FireflyIII\Support\WhitelabelConfiguration;

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
        $domain = $request->getHost();

        /** @var \FireflyIII\Models\Whitelabel $whitelabel */
        $whitelabel = \FireflyIII\Models\Whitelabel::where('domain', $domain)
            ->where('active', true)
            ->first();
        if ($whitelabel !== null) {
            static::setConfig($whitelabel);
        }

        return $next($request);
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
