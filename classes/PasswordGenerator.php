<?php
class PasswordGenerator {
    public static function generate($length, $upper, $lower, $num, $special) {
        $u = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $l = 'abcdefghijklmnopqrstuvwxyz';
        $n = '0123456789';
        $s = '!@#$%^&*()_+-=[]{}|';
        $password = '';

        $password .= substr(str_shuffle($u), 0, $upper);
        $password .= substr(str_shuffle($l), 0, $lower);
        $password .= substr(str_shuffle($n), 0, $num);
        $password .= substr(str_shuffle($s), 0, $special);

        $remaining = $length - strlen($password);
        $all = $u . $l . $n . $s;
        $password .= substr(str_shuffle($all), 0, $remaining);

        return str_shuffle($password);
    }
}
