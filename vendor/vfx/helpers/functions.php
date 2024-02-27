<?php

function debug(mixed $data, $die = false)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
    if ($die) {
        die;
    }
}

function vite(string $path): string|null
{
    $manifest_file = WWW_PATH . "/build/assets/manifest.json";
    if(file_exists($manifest_file)) {
        $json_data = file_get_contents($manifest_file);
        $data = json_decode($json_data, true);

        if(isset($data[$path])) {
            return '/build/' . $data[$path]['file'];
        }
    }

    return null;
}

function image(string $img): string
{
    $path = WWW_PATH . '/' . IMAGE_PATH . '/' . trim($img, '/');
    $image_src = IMAGE_PATH . '/' . trim($img, '/');

    if(file_exists($path)) {
        return $image_src;
    }
    return IMAGE_PATH . '/' . trim(NO_IMAGE, '/');
}

function lang(string $key): string
{
    return \vfx\Lang::get($key) ?? $key;
}

function toArrayKey(array $array, string $index): array
{
    if(count($array) > 0) {
        $new_array = [];
        foreach ($array as $key => $value) {
            if (is_array($value) && isset($value[$index])) {
                $new_array[$value[$index]] = $value;
            } else {
                $new_array[$key] = $value;
            }
        }
        return $new_array;
    }
}