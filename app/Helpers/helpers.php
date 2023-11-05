<?php

use SebastianBergmann\Type\NullType;

if (!function_exists('saveImage')) {
    function saveImage($path, $image): ?string
    {
        try {
            $imageName = time() . 'app.' . $image->extension();
            $image->move(public_path("storage/$path"), $imageName);
            $host = request()->getHost();
            if (str_contains($host, 'localhost') || str_contains($host, '127.0.0.1')) {
                return "storage/$path/$imageName";
            } else {
                return "public/storage/$path/$imageName";
            }
        } catch (\Throwable $th) {
            return null;
        }
    }
}

if (!function_exists('toArray')) {
    function toArray($values)
    {
        $array = [];
        foreach ($values as $value) {
            $array[] = $value;
        }
        return $array;
    }
}

if (!function_exists('put_permanent_env')) {
    function put_permanent_env($key, $value)
    {
        $path = app()->environmentFilePath();

        $escaped = preg_quote('=' . env($key), '/');

        file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($path)
        ));
    }
}
if (!function_exists('setEnvironmentValue')) {
    function setEnvironmentValue(string $envKey, $envValue)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        $oldValue = env($envKey);
        $str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}", $str);
        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
    }
}
