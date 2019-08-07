<?php

namespace FireflyIII\Support;

use Illuminate\Contracts\Translation\Loader;
use Illuminate\Translation\Translator as LaravelTranslator;

class WhitelabelTranslator extends LaravelTranslator
{

    public function __construct(Loader $loader, string $locale)
    {
        parent::__construct($loader, $locale);
    }

    public function trans($key, array $replace = [], $locale = null)
    {
        return static::replaceFirefly(
            parent::trans($key, $replace, $locale)
        );
    }

    public function makeReplacements($line, array $replace)
    {
        return static::replaceFirefly(
            parent::makeReplacements($line, $replace)
        );
    }

    public static function replaceFirefly($content)
    {
        $default_app_name = [
            'Firefly III',
            'FireflyIII',
        ];
        return str_replace($default_app_name, config('app.name'), $content);
    }
}