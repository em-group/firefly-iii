<?php

if (!function_exists('whitelabelconfig')) {
    function whitelabelconfig(string $name, $default = null) {
        $config = \FireflyIII\Support\Facades\WhitelabelConfig::get($name, $default);
        if ($config === null) {
            return null;
        }
        return $config->value;
    }
}