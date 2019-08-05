<?php

namespace FireflyIII\Helpers\FeatureAccess;


/**
 * @method static static invalid()
 * @method static static basic()
 * @method static static premium()
*/
class UserLevel
{
    const INVALID_LEVEL = 0;
    const BASIC_LEVEL   = 1;
    const PREMIUM_LEVEL = 2;

    const INVALID = 'invalid';
    const BASIC = 'basic';
    const PREMIUM = 'premium';

    /**
     * @var string[] $userLevels
    */
    static public $userLevels = [
        self::INVALID_LEVEL => self::INVALID,
        self::BASIC_LEVEL => self::BASIC,
        self::PREMIUM_LEVEL => self::PREMIUM
    ];
    static public $stringLevels = [
        self::INVALID => self::INVALID_LEVEL,
        self::BASIC => self::BASIC_LEVEL,
        self::PREMIUM => self::PREMIUM_LEVEL
    ];

    public $level = 0;

    public function __construct(string $level)
    {
        $this->level = static::$stringLevels[$level];
    }

    public function __toString()
    {
        return static::$userLevels[$this->level];
    }

    static public function __callStatic($method, $args)
    {
        if (!empty(static::$stringLevels[$method])) {
            return new static($method);
        }
        return new static(static::INVALID);
    }

}