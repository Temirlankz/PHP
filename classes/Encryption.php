<?php
class Encryption {
    public static function encrypt($data, $key) {
        $iv = str_pad(substr($key, 0, 16), 16, "\0");
        return openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
    }

    public static function decrypt($data, $key) {
        $iv = str_pad(substr($key, 0, 16), 16, "\0");
        return openssl_decrypt($data, 'AES-256-CBC', $key, 0, $iv);
    }
}
