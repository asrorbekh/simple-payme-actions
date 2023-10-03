<?php

namespace App\Service;

class LogService
{
    public static function log(string $filename, mixed $data): void
    {
        if ($data) {
            $data = json_encode($data, JSON_PRETTY_PRINT);

            $logPath = LOG_PATH;

            if (!is_dir($logPath)) {
                mkdir($logPath, 0755, true);
            }

            $log_file = $logPath . $filename . '.log';

            $log_message = '[' . date('Y-m-d H:i:s') . '] ' . $data . PHP_EOL;
            file_put_contents($log_file, $log_message, FILE_APPEND | LOCK_EX);
        }
    }

    public static function data(mixed $data, bool $exit = true): void
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        if ($exit) {
            exit;
        }
    }

    public static function jsonPretty(mixed $data): false|string
    {
        $json = json_encode($data, JSON_PRETTY_PRINT);

        return "<pre>$json</pre>";
    }
}