<?php

namespace RST\Base;

/**
 * Abstract Singleton class. Use for inheritance
 * @package RST\Base
 */
abstract class Singleton
{

    /** @var array $instances */
    protected static $instances = [];

    /**
     * Instance getter
     * @return Singleton Instance
     */
    public static function getInstance()
    {
        if (empty(self::$instances[static::class])) {
            $instance = new static();

            self::$instances[static::class] = $instance;
        } else {
            $instance = self::$instances[static::class];
        }

        return $instance;
    }

    protected function __construct() {}
    protected function __clone() {}
    protected function __wakeup() {}

}
