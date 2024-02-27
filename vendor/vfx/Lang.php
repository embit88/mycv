<?php

namespace vfx;

abstract class Lang
{
    public static array $words = [];
    public static string $path = '';
    public static string $locale = '';

    public static function getWords(string|null $locale = null, string|null $path = null): array
    {
        $locale = $locale ?? App::$app->getProperty('locale') ?? 'en';
        $path = !empty($path) ? LANG_PATH . '/' . $locale . '/' . trim($path, '/') . '.php' : LANG_PATH . '/' . $locale . '/main.php';
        if(file_exists($path)) {
            self::$locale = $locale;
            self::$path = $path;
            self::$words = require_once $path;
        }

        return self::$words;
    }

    public static function get(string $key): string
    {
        return self::$words[$key] ?? $key;
    }

}