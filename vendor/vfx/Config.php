<?php

namespace vfx;

use vfx\traits\Singleton;

class Config
{

    use Singleton;

    protected static array $properties = [];

    public function setProperty(string $name, mixed $value): mixed
    {
        return self::$properties[$name] = $value;
    }

    public function getProperty($name): mixed
    {
        return self::$properties[$name] ?? null;
    }

    public function getProperties(): array
    {
        return self::$properties;
    }

    public static function startConfig($object): void
    {
        $config = require_once CONFIG_PATH . '/config.php';
        if(!empty($config) && is_array($config) && count($config) > 0) {
            foreach ($config as $key => $value) {
                if(!$object->getProperty($key)) {
                    $object->setProperty($key, $value);
                }
            }
        }
    }


}