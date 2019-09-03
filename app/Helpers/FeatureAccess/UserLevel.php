<?php

namespace FireflyIII\Helpers\FeatureAccess;


/**
 * @method static static basic()
 * @method static static premium()
*/
class UserLevel
{
    const BASIC_LEVEL   = 0;
    const PREMIUM_LEVEL = 1;

    const BASIC = 'Basic';
    const PREMIUM = 'Premium';

    /**
     * @var string[] $userLevels
    */
    static public $userLevels = [
        self::BASIC_LEVEL => self::BASIC,
        self::PREMIUM_LEVEL => self::PREMIUM
    ];
    static public $stringLevels = [
        self::BASIC => self::BASIC_LEVEL,
        self::PREMIUM => self::PREMIUM_LEVEL
    ];

    public $level = self::BASIC_LEVEL;

    public function __construct(int $level)
    {
        $this->level = $level;
    }

    public function __toString()
    {
        return static::$userLevels[$this->level];
    }

    static public function __callStatic($method, $args)
    {
        if (!empty(static::$stringLevels[$method])) {
            return new static(static::$stringLevels[$method]);
        }
        return new static(static::BASIC_LEVEL);
    }

}