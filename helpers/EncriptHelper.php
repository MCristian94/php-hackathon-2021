<?php


namespace helpers;


class EncriptHelper
{

    protected const options = ['cost' => 11];

    public static function encriptPassword($password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT, self::options);
        return $hash;
    }

    public static function verifyPassword($tipedPassword, $existingUserPassword)
    {
        return password_verify($tipedPassword, $existingUserPassword);
    }
}