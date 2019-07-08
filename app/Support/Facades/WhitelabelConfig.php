<?php

namespace FireflyIII\Support\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @codeCoverageIgnore
 * Class WhitelabelConfig
 * @method null|\FireflyIII\Models\WhitelabelConfig get($name, $default = null)
 * @method \FireflyIII\Models\WhitelabelConfig set(string $name, $value)
 * @method delete(string $name)
 * @method \FireflyIII\Models\WhitelabelConfig|null getFresh(string $name, $default = null)
 * @method \FireflyIII\Models\WhitelabelConfig put(string $name, $value)
*/
class WhitelabelConfig extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'whitelabelconfig';
    }
}