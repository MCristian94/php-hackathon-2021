<?php


namespace helpers;


class EncriptHelper
{
// cu minunatia asta am inteles ca se poate face securizarea si encriptarea datelor mult mai bine.. nu stiu nu bag mana in fog ca am dreptate
// daca veti idei si sucestii chiar va rog sa imi dati
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