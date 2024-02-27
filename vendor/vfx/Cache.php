<?php

namespace vfx;

use vfx\traits\Singleton;

abstract class Cache
{

    public static function set(string $key, mixed $data, int $time = 3600*24): bool
    {
        $content['data'] = $data;
        $content['end_time'] = time() + $time;
        $path = CACHE_PATH . '/' . md5($key) . '.txt';
        if(file_put_contents($path, serialize($content))) {
            return true;
        }

        return false;
    }

    public static function get(string $key): mixed
    {
        $path = CACHE_PATH . '/' . md5($key) . '.txt';
        if(file_exists($path)) {
            $content = unserialize(file_get_contents($path));
            if(time() <= $content['end_time']) {
                return $content['data'];
            }
            unlink($path);
        }
        return false;
    }

    public static function delete(string $key): void
    {
        $path = CACHE_PATH . '/' . md5($key) . '.txt';
        if(file_exists($path)) {
            unlink($path);
        }
    }

    public static function deleteAll(): void
    {
        $path = CACHE_PATH . '/';
        if(file_exists($path)) {
            array_map('unlink', glob("{$path}*"));
        }
    }

}