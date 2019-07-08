<?php

namespace FireflyIII\Support;

use FireflyIII\Models\Whitelabel;
use Illuminate\Support\Facades\Cache;

class WhitelabelConfiguration
{
    /** @var Whitelabel $whitelabel */
    public $whitelabel;

    public $cachePrefix = '';

    public function __construct(Whitelabel $whitelabel = null)
    {
        if ($whitelabel === null) {
            $whitelabel = Whitelabel::first();
        }
        $this->whitelabel = $whitelabel;
        $this->cachePrefix = 'wl-'.$this->whitelabel->id.'-';
    }

    public function delete(string $name): void
    {
        if (Cache::has($this->cachePrefix . $name)) {
            Cache::forget($this->cachePrefix . $name);
        }

        try {
            $this->whitelabel->config()->where('name', $name)->delete();
        } catch (\Exception $ex) {
            //
        }
    }

    public function get(string $name, $default = null): ?\FireflyIII\Models\WhitelabelConfig
    {
        if (Cache::has($this->cachePrefix . $name)) {
            return Cache::get($this->cachePrefix . $name);
        }

        /** @var \FireflyIII\Models\WhitelabelConfig $config */
        $config = $this->whitelabel->config()->where('name', $name)->first(['id', 'whitelabel_id', 'name', 'value']);

        if ($config) {
            Cache::forever($this->cachePrefix . $name, $config);

            return $config;
        }

        if (null === $default) {
            return null;
        }

        return $this->set($name, $default);
    }

    public function getFresh(string $name, $default = null): ?\FireflyIII\Models\WhitelabelConfig
    {
        /** @var \FireflyIII\Models\WhitelabelConfig $config */
        $config = $this->whitelabel->config()->where('name', $name)->first(['id', 'whitelabel_id', 'name', 'value']);
        if ($config) {
            return $config;
        }

        if (null === $default) {
            return null;
        }

        return $this->set($name, $default);
    }

    public function put(string $name, $value): \FireflyIII\Models\WhitelabelConfig
    {
        return $this->set($name, $value);
    }

    public function set(string $name, $value): \FireflyIII\Models\WhitelabelConfig
    {
        /** @var \FireflyIII\Models\WhitelabelConfig $config */
        $config = $this->whitelabel->config()->where('name', $name)->first();
        if (null === $config) {
            $item = new \FireflyIII\Models\WhitelabelConfig;
            $item->whitelabel_id = $this->whitelabel->id;
            $item->name = $name;
            $item->value = $value;
            $item->save();

            Cache::forget($this->cachePrefix . $name);

            return $item;
        }
        $config->value = $value;
        $config->save();

        Cache::forget($this->cachePrefix . $name);

        return $config;
    }
}