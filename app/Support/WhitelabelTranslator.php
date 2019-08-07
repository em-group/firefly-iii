<?php

namespace FireflyIII\Support;

use FireflyIII\Helpers\Help\Help;
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
        return $this->replaceFirefly(
            parent::trans($key, $replace, $locale)
        );
    }

    public function makeReplacements($line, array $replace)
    {
        return $this->replaceFirefly(
            parent::makeReplacements($line, $replace)
        );
    }

    protected function replaceFirefly($content)
    {
        return Help::changeAppName($content);
    }
}