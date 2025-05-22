<?php
class Encryption {
    public static function encrypt($data, $key) {
        $iv = substr($key, 0, 16); // Ensure IV is 16 bytes
        return openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
    }

    public static function decrypt($data, $key) {
        $iv = substr($key, 0, 16);
        return openssl_decrypt($data, 'AES-256-CBC', $key, 0, $iv);
    }
}
