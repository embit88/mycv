<?php

namespace vfx\traits;

trait Singleton
{

    private static self|null $instance = null;

    private function __construct(){}

    public static function getInstance(): static
    {
        return static::$instance ?? static::$instance = new static();
    }

}